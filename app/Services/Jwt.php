<?php

namespace App\Services;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use App\Exceptions\Jwt\JwtPastDueException;
use App\Exceptions\Jwt\JwtInvalidSignatureException;

class Jwt
{
    protected $config;

    public function __construct($jwtConfig)
    {
        $this->config = $jwtConfig;
    }

    /**
     * Creates the secure JSON Web Token with the given user info.
     * 
     * @param object
     * @param integer
     * @return string
     */
    public function encodeToken($value)
    {
        $token = (new Builder())
            ->setHeader('alg', 'HS256')
            ->setIssuedAt(time() + $this->config['issuedAt'])
            ->setExpiration(time() + $this->config['usr_token_exp_time_lapse'])
            ->set('info', $value)
            ->sign(new Sha256(), $this->config['secret'])
            ->getToken();

        return (string)$token;
    }

    /**
     * Retrieves the Userinfo from the JSON Web Token recieved.
     * 
     * @param string
     * @return array
     */
    public function decodeToken($token)
    {
        // Parse and validate token.
        $parsedToken = $this->validateToken($token);

        // Get the User info array from the JWT info Claim.
        return $parsedToken->getClaim('info');
    }

    /**
     * Updates the Userinfo in the JSON Web Token with given array of data.
     * WARNING: REPEATED ARRAY KEYS WILL BE OVERRIDEN WITH $data KEYS AND VALUES!.
     * 
     * @param string
     * @param array
     * @return string
     */
    public function refreshToken($token, $data)
    {
        $parsedData = json_decode(
            json_encode(
                $this->decodeToken($token)
            ),
            true
        );

        $refreshedToken = $this->encodeToken(
            array_merge(
                $parsedData,
                $data
            ),
            $this->config['usr_token_exp_time_lapse']
        );

        return $refreshedToken;
    }

    /**
     * Validate given token to have a valid signature and time validation.
     * Returns parsed token.
     * 
     * @param string
     * @return void
     */
    public function validateToken($token)
    {
        // Parse token.
        $parsedToken = (new Parser())->parse($token);

        // Here we validate token's signature.
        if (!$parsedToken->verify(new Sha256(), $this->config['secret'])) {
            throw new JwtInvalidSignatureException();
        }

        // Here we validate that token is not older than 24 hours.
        if (!$parsedToken->validate(new ValidationData())) {
            throw new JwtPastDueException();
        }

        return $parsedToken;
    }

    /**
     * Returns parsed token without signature validation.
     * 
     * @param string
     * @return string
     */
    public function parseToken($token)
    {
        return (new Parser())->parse($token);
    }
}

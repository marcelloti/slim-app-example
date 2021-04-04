<?php
namespace SlimExample\Modules\Authentication\Services;
use SlimExample\Acl\Domain\UsersAcl;

use SlimExample\Modules\Authentication\Repositories\AuthTokensRepository;
use SlimExample\Acl\Infra\TokenGenerator\TokenGeneratorLib;

class LoginService {
    protected function getAuthTokenDataInDatabaseByUserId(string $userId): ?array {
        $tokenRepo = new AuthTokensRepository();

        $findData = [
            ['userid', '=', $userId],
        ];

        $results = $tokenRepo->findBy($findData);

        return count($results) === 1 ? $results[0] : null;
    }

    public function getAuthTokenDataInDatabaseByToken(string $token): ?array {
        $tokenRepo = new AuthTokensRepository();

        $findData = [
            ['token', '=', $token]
        ];

        $results = $tokenRepo->findBy($findData);

        return count($results) === 1 ? $results[0] : null;
    }

    protected function registerNewAuthTokenInDatabase(string $userId, string $secret, string $token): void {
        $tokenRepo = new AuthTokensRepository();
        $currentTokenData = LoginService::getAuthTokenDataInDatabaseByUserId($userId);

        $dateNow = new \DateTime();

        if ($currentTokenData === null){
            $newData = [
                [
                    'userid'=> $userId,
                    'token'=> $token,
                    'secret'=> $secret,
                    'created_at' => $dateNow->format('Y-m-d H:i:s'),
                    'updated_at' => $dateNow->format('Y-m-d H:i:s')
                ],
            ];
    
            $tokenRepo->insert($newData);
        } else {
            $filter = [
                ['userid', '=', $userId],
            ];

            $updatedData = [
                'secret'=> $secret,
                'token'=> $token,
                'updated_at' => $dateNow->format('Y-m-d H:i:s')
            ];
    
            $tokenRepo->update($filter, $updatedData);
        }
    }

    public static function getNewAuthToken(string $email, string $senha): string {
        $findData = [
            ['email', '=', $email,],
            ['senha', '=', $senha]
        ];

        $dadosConsulta = UsersAcl::findUsers($findData);

        if (count($dadosConsulta) === 0){
            return '';
        }

        $userId = $dadosConsulta[0]['id'];
        $secret = "SeC_".substr(uniqid(), 0, 6)."_#";
        $expiration = time() + 3600;
        $issuer = 'localhost';

        $token = TokenGeneratorLib::generate($userId, $secret, $expiration, $issuer);

        LoginService::registerNewAuthTokenInDatabase($userId, $secret, $token);

        return $token;
    }

    public static function validateAuthToken(string $token): bool {
        $tokenData = LoginService::getAuthTokenDataInDatabaseByToken($token);
        if ($tokenData === null){
            return false;
        }

        return TokenGeneratorLib::validate($tokenData['token'], $tokenData['secret']);
    }
}
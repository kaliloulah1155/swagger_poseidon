<?php 
header('Content-Type:application/json');
require_once('../../core/config.php');
require_once '../../core/JWT.php';
error_reporting(E_ALL);
ini_set('display_error',1);

/**
 * @OA\Info(title="APPNGSYS Rest Api", version="1.0"),
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 * ),
 */

class Login{
    
    private $jwt;
    public $user_info;
    public $token;
    public $header;
    public $payload;
    public $response;
   
     /**
     * @OA\Get(
     * path="/API_RES_POSEIDON/api/authentication/Logger.php",
     * summary="Token de connexion",
     * tags={"Authentification"},
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not found"),
     * )
     */
    public function logger(){

        //On crée le header
        $this->header=[
                'typ'=>'JWT',
                'alg'=>'HS256'
            ];
    
        //On crée le contenu (payload)
        $this->payload=[
            'user_id'=>123,
            'owner'=>'POSEIDON JWT',
            'roles'=>[
                'ROLE_ADMIN',
                'ROLE_USER'
            ],
            'email'=>'pos_jwt@sesin_afrika.fr'
        ]; 
         $this->jwt=new JWT();

        //$token=$jwt->generate($header,$payload,SECRET,60);
        $this->token=$this->jwt->generate($this->header,$this->payload,SECRET,(60*60*24)); // 1 jour

        $this->response=[
            'user_info'=>$this->payload,
            'token'=>$this->token
        ];
        return $this->response;

    }
}
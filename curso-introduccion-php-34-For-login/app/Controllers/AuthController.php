<?php
namespace App\Controllers;

use App\Models\User;
use Respect\Validation\Validator as v;
use Zend\Diactoros\Response\RedirectResponse;

class AuthController extends BaseController {
    public function getLogin() {
        return $this->renderHTML('login.twig');
    }

    public function postLogin($request) {
        $postData = $request->getParsedBody();
        $responseMenssage = null;

        $user = User::where('email', $postData['email'])->first();
        if ($user) {
          if (password_verify($postData['password'], $user->password)) {
            return new RedirectResponse('/admin');
          }else {
            $responseMenssage='Bad credentials';
          }
        }else {
          $responseMenssage='Bad credentials';
        }

        return $this->renderHTML('login.twig',[
          'responseMessage' => $responseMenssage
        ]);
    }
}

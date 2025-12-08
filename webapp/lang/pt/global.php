<?php

return [
    'common' => [
        'home' => 'Início',
        'search' => 'Pesquisar',
        'app_name' => 'Geoglify',
        'powered_by' => 'Desenvolvido por GEOGLIFY v1.0.0',
        'saved' => 'Guardado.',

        'fields' => [
            'name' => 'Nome',
            'email' => 'Email',
            'password' => 'Palavra-passe',
            'password_confirmation' => 'Confirmar Palavra-passe',
            'description' => 'Descrição',
        ],
    ],

    'navigation' => [
        'dashboard' => 'Mapa',
        'users' => 'Utilizadores',
        'roles' => 'Funções',
        'configurations' => 'Configurações',
        'logout' => 'Sair',
    ],

    'actions' => [
        'create' => 'Criar',
        'edit' => 'Editar',
        'update' => 'Atualizar',
        'delete' => 'Eliminar',
        'cancel' => 'Cancelar',
        'save' => 'Guardar',
        'confirm' => 'Confirmar',
        'select_all' => 'Selecionar Tudo',
        'deselect_all' => 'Desselecionar Tudo',
    ],

    'auth' => [
        'login_title' => 'Iniciar Sessão',
        'login_button' => 'Entrar',
        'register_title' => 'Registar',
        'register_button' => 'Registar',
        'logout' => 'Terminar Sessão',
        'forgot_password_title' => 'Esqueceu a Palavra-passe',
        'reset_password_title' => 'Redefinir Palavra-passe',
        'reset_password_button' => 'Redefinir Palavra-passe',
        'reset_button' => 'Redefinir',
        'confirm_password_title' => 'Confirmar Palavra-passe',
        'confirm_button' => 'Confirmar',
        'verify_email_title' => 'Verificação de Email',
        'resend_verification' => 'Reenviar Email de Verificação',
        'back_to_login' => 'Voltar ao login',
        'logged_in_message' => 'Sessão iniciada com sucesso!',
        'login' => 'Entrar',

        'already_have_account' => 'Já tem uma conta?',
        'forgot_password_message' => 'Esqueceu-se da sua palavra-passe? Sem problema. Basta indicar o seu endereço de email e enviaremos um link de redefinição de palavra-passe que lhe permitirá escolher uma nova.',
        'reset_password_message' => 'Redefina a sua palavra-passe, insira a sua nova palavra-passe e confirme-a.',
        'confirm_password_message' => 'Esta é uma área segura da aplicação. Por favor, confirme a sua palavra-passe antes de continuar.',
        'verify_email_message' => 'Obrigado por se registar! Antes de começar, pode verificar o seu endereço de email clicando no link que acabámos de lhe enviar? Se não recebeu o email, teremos todo o prazer em enviar-lhe outro.',
        'verification_link_sent' => 'Foi enviado um novo link de verificação para o endereço de email que forneceu durante o registo.',
        'register_question' => 'Não tem conta?',
        'remember_me' => 'Lembrar-me',
        'forgot_password' => 'Esqueceu a palavra-passe?',
        'otp' => [
            'login_code' => 'Entrar com Código',
            'back_login' => 'Voltar ao Login',
            'enter_email' => 'Introduza o seu email para receber um código de acesso único.',
            'send_code' => 'Enviar Código',
            'verify_code' => 'Verificar Código',
            'change_email' => 'Alterar Email',
            'enter_code' => 'Por favor, introduza o código de 6 dígitos enviado para {email}',
            'verify_login' => 'Verificar e Entrar',
            'no_code' => 'Não recebeu o código?',
            'resend' => 'Reenviar',
        ],
    ],

    'users' => [
        'title' => 'Utilizadores',
        'create_title' => 'Criar Utilizador',
        'edit_title' => 'Editar Utilizador',
        'import' => 'Importar',
        'delete_confirmation_title' => 'Tem a certeza de que deseja eliminar esta conta?',
        'delete_warning' => 'Assim que esta conta for eliminada, todos os seus recursos e dados serão permanentemente eliminados.',

        'fields' => [
            'type' => 'Tipo',
            'role' => 'Função',
        ],
    ],

    'roles' => [
        'title' => 'Funções',
        'create_title' => 'Criar Função',
        'edit_title' => 'Editar Função',
        'permissions' => 'Permissões',
        'select_permissions' => 'Selecionar permissões para a função',
        'selected_permissions' => 'Permissões Selecionadas',
        'permissions_count' => 'Permissões',
        'delete_confirmation_title' => 'Tem a certeza de que deseja eliminar esta função?',
        'delete_warning' => 'Assim que esta função for eliminada, todos os seus recursos e dados serão permanentemente eliminados.',
        'created_successfully' => 'Função criada com sucesso',
        'updated_successfully' => 'Função atualizada com sucesso',
        'deleted_successfully' => 'Função eliminada com sucesso',

        'fields' => [
            'title' => 'Título',
            'description' => 'Descrição',
            'permissions' => 'Permissões',
        ],

        'groups' => [
            'users' => 'Utilizadores',
            'roles' => 'Funções',
        ],
    ],

    'profile' => [
        'title' => 'Perfil',
        'information_title' => 'Informações do Perfil',
        'information_description' => 'Atualize as informações do perfil e o endereço de email da sua conta.',
        'update_password_title' => 'Atualizar Palavra-passe',
        'update_password_description' => 'Certifique-se de que a sua conta está a usar uma palavra-passe longa e aleatória para se manter seguro.',
        'delete_account_title' => 'Eliminar Conta',
        'delete_account_description' => 'Assim que a sua conta for eliminada, todos os seus recursos e dados serão permanentemente eliminados.',
        'delete_account_button' => 'Eliminar Conta',
        'delete_confirmation_title' => 'Tem a certeza de que deseja eliminar a sua conta?',
        'delete_confirmation_message' => 'Assim que a sua conta for eliminada, todos os seus recursos e dados serão permanentemente eliminados. Por favor, introduza a sua palavra-passe para confirmar que deseja eliminar permanentemente a sua conta.',
        'email_unverified' => 'O seu endereço de email não está verificado.',
        'resend_verification' => 'Clique aqui para reenviar o email de verificação.',
        'verification_sent' => 'Foi enviado um novo link de verificação para o seu endereço de email.',

        'fields' => [
            'current_password' => 'Palavra-passe Atual',
            'new_password' => 'Nova Palavra-passe',
            'password' => 'Palavra-passe'
        ],
    ],

    'permissions' => [
        'users_create' => 'Criar utilizadores',
        'users_edit' => 'Editar utilizadores',
        'users_destroy' => 'Eliminar utilizadores',
        'users_show' => 'Ver utilizadores',
        'users_list' => 'Listar utilizadores',
        'roles_create' => 'Criar funções',
        'roles_edit' => 'Editar funções',
        'roles_destroy' => 'Eliminar funções',
        'roles_show' => 'Ver funções',
        'roles_list' => 'Listar funções',
    ],
];

<?php

return [
    'common' => [
        'home' => '首页',
        'search' => '搜索',
        'app_name' => 'Geoglify',
        'app_subtitle' => '经久耐用',
        'powered_by' => '由 GEOGLIFY v1.0.0 驱动',
        'saved' => '已保存.',
        'fields' => [
            'name' => '名称',
            'email' => '邮箱',
            'password' => '密码',
            'password_confirmation' => '确认密码',
            'description' => '描述',
        ],
    ],

    'navigation' => [
        'dashboard' => '地图',
        'users' => '用户',
        'roles' => '角色',
        'configurations' => '配置',
        'logout' => '退出登录',
    ],

    'actions' => [
        'create' => '创建',
        'edit' => '编辑',
        'update' => '更新',
        'delete' => '删除',
        'cancel' => '取消',
        'save' => '保存',
        'confirm' => '确认',
        'select_all' => '全选',
        'deselect_all' => '取消全选',
    ],

    'auth' => [
        'login_title' => '登录',
        'login_button' => '登录',
        'register_title' => '注册',
        'register_button' => '注册',
        'logout' => '退出登录',
        'forgot_password_title' => '忘记密码',
        'reset_password_title' => '重置密码',
        'reset_password_button' => '重置密码',
        'reset_button' => '重置',
        'confirm_password_title' => '确认密码',
        'confirm_button' => '确认',
        'verify_email_title' => '邮箱验证',
        'resend_verification' => '重新发送验证邮件',
        'back_to_login' => '返回登录',
        'logged_in_message' => '你已登录！',

        'already_have_account' => '已有账号?',
        'forgot_password_message' => '忘记密码?没关系,输入邮箱即可收到重置链接.',
        'reset_password_message' => '请输入新密码并确认以重置密码.',
        'confirm_password_message' => '这是安全区域,请先确认密码继续操作.',
        'verify_email_message' => '感谢注册！请点击邮件中的链接完成邮箱验证.',
        'verification_link_sent' => '新的验证邮件已发送到你的邮箱.',
        'register_question' => '还没有账号?',
        'remember_me' => '记住我',
        'forgot_password' => '忘记密码?',

        'otp' => [
            'login_code' => '验证码登录',
            'back_login' => '返回登录',
            'enter_email' => '请输入邮箱以接收一次性登录验证码.',
            'send_code' => '发送验证码',
            'verify_code' => '验证验证码',
            'change_email' => '更换邮箱',
            'enter_code' => '请输入发送到 {email} 的 6 位验证码',
            'verify_login' => '验证并登录',
            'no_code' => '没有收到验证码?',
            'invalid' => '验证码无效.',
            'expired' => '验证码已过期.',
            'resend' => '重新发送',
        ],
    ],

    'users' => [
        'title' => '用户管理',
        'create_title' => '创建用户',
        'edit_title' => '编辑用户',
        'import' => '导入',
        'delete_confirmation_title' => '确定要删除该用户吗?',
        'delete_warning' => '删除后,该用户的所有数据将永久删除.',

        'fields' => [
            'type' => '类型',
            'role' => '角色',
        ],
    ],

    'roles' => [
        'title' => '角色管理',
        'create_title' => '创建角色',
        'edit_title' => '编辑角色',
        'permissions' => '权限',
        'select_permissions' => '选择角色权限',
        'selected_permissions' => '已选权限',
        'permissions_count' => '权限数量',
        'delete_confirmation_title' => '确定要删除该角色吗?',
        'delete_warning' => '删除后,该角色相关数据将永久删除.',
        'created_successfully' => '角色创建成功',
        'updated_successfully' => '角色更新成功',
        'deleted_successfully' => '角色删除成功',

        'fields' => [
            'title' => '标题',
            'description' => '描述',
            'permissions' => '权限',
        ],

        'groups' => [
            'users' => '用户',
            'roles' => '角色',
        ],
    ],

    'profile' => [
        'title' => '个人资料',
        'information_title' => '资料信息',
        'information_description' => '更新你的账户信息与邮箱地址.',
        'update_password_title' => '修改密码',
        'update_password_description' => '请使用强密码保护账户安全.',
        'delete_account_title' => '删除账户',
        'delete_account_description' => '账户删除后所有数据将永久移除.',
        'delete_account_button' => '删除账户',
        'delete_confirmation_title' => '确定要删除账户吗?',
        'delete_confirmation_message' => '请输入密码确认删除账户,此操作不可恢复.',
        'email_unverified' => '邮箱未验证.',
        'resend_verification' => '点击重新发送验证邮件.',
        'verification_sent' => '验证邮件已发送.',

        'fields' => [
            'current_password' => '当前密码',
            'new_password' => '新密码',
            'password' => '密码',
        ],
    ],

    'permissions' => [
        'users_create' => '创建用户',
        'users_edit' => '编辑用户',
        'users_destroy' => '删除用户',
        'users_show' => '查看用户',
        'users_list' => '用户列表',
        'roles_create' => '创建角色',
        'roles_edit' => '编辑角色',
        'roles_destroy' => '删除角色',
        'roles_show' => '查看角色',
        'roles_list' => '角色列表',
    ],
];

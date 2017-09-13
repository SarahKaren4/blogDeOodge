<?php
return [
    'titles' => [
        'info' => 'Информация',
        'permissions' => 'Права доступа',
        'permission_create' => 'Создать право доступа',
        'permission_delete' => 'Удалить право доступа',
        'permission_edit' => 'Редактирование права доступа',
        'roles' => 'Роли пользователя',
        'role_create' => 'Создать роль',
        'role_show' => 'Просмотр роли',
        'role_edit' => 'Редактирование роли',
        'role_delete' => 'Удалить роль',
        'admin_users' => 'Пользователи админ зоны',
        'admin_user_create' => 'Создать учетную запись администратора',
        'admin_user_edit' => 'Редактировать администратора',
        'admin_user_show' => 'Просмотр учетной записи администратора',
        'admin_user_delete' => 'Удалить учетную запись',
        'site_users' => 'Пользователи сайта',
        'site_user_create' => 'Создать учетную запись пользователя',
        'site_user_show' => 'Просмотр учетной записи пользователя',
        'site_user_edit' => 'Редактировать пользователя',
        'site_user_delete' => 'Удалить пользователя',
    ],
    'tables' => [
        'id' => 'ID',
        'permission' => 'Право доступа',
        'role' => 'Роль',
        'name' => 'Название',
        'first_name' => 'Имя',
        'description' => 'Описание',
        'actions' => 'Действия',
        'dates' => 'Дата создания/обновления',
        'relation_name' => 'Название связи',
        'relations_count' => 'Количество связей',
        'roles' => 'Роли',
        'permissions' => 'Права доступа',
        'users' => 'Пользователи',
        'admins' => 'Администраторы',
        'email' => 'E-mail',
    ],
    'labels' => [
        'name' => 'Алиас',
        'display_name' => 'Название',
        'description' => 'Описание',
        'first_name' => 'Имя',
        'email' => 'E-mail',
        'new_password' => 'Новый пароль',
        'change_password' => 'Поменять пароль',
        'role' => 'Роль',
    ],
    'texts' => [
        'warning_relations' => 'Данная запись имеет связи. В случае удаления все связи будут утеряны',
        'warning_important_relations' => 'Данная запись имеет важные связи. Вы не можете сейчас произвести удаление. Постарайтесь убрать эти связи перед удалением.',
    ],
    'buttons' => [
        'role_back' => 'Вернуться к списку ролей',
        'admin_back' => 'Вернуться к списку администраторов',
        'user_back' => 'Вернуться к списку пользователей',
    ],
    'alerts' => [
        'role_store_success' => 'Отлично! Новая роль была успешно создана',
        'role_update_success' => 'Отлично! Роль была успешно обновлена',
        'role_delete_success' => 'Отлично! Роль была успешно удалена',
        'permission_store_success' => 'Отлично! Новое право доступа было успешно создано',
        'permission_update_success' => 'Отлично! Право доступа успешно обновлено',
        'permission_delete_success' => 'Отлично! Право доступа успешно удалено',
        'admin_user_store_success' => 'Отлично! Новый пользователь админ зоны успешно создан',
        'admin_user_update_success' => 'Отлично! Пользователь админ зоны был успешно обновлен',
        'admin_user_delete_success' => 'Отлично! Пользователь админ зоны был успешно удален',
        'site_user_store_success' => 'Отлично! Ноый пользователь сайта был успешно создан',
        'site_user_update_success' => 'Отлично! Пользователь сайта был успешно обновлен',
        'site_user_delete_success' => 'Отлично! Пользователь сайта был успешно удален',
    ],
];

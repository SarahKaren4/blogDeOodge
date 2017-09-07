<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute должен быть принятым.',
    'active_url'           => ':attribute не верный URL.',
    'after'                => ':attribute должен быть позже :date.',
    'after_or_equal'       => ':attribute должен быть больше или равен :date.',
    'alpha'                => ':attribute может содержать только буквы.',
    'alpha_dash'           => ':attribute может содержать только буквы, цифры и тире.',
    'alpha_num'            => ':attribute может содержать только буквы и цифры.',
    'array'                => ':attribute должен быть массивом.',
    'before'               => ':attribute должен быть ранее :date.',
    'before_or_equal'      => ':attribute должен быть ранее или равен :date.',
    'between'              => [
        'numeric' => ':attribute должен быть в пределах :min и :max.',
        'file'    => ':attribute должен быть в пределах :min и :max Кб.',
        'string'  => ':attribute должен сожержать символов от :min до :max.',
        'array'   => ':attribute должен содержать от :min до :max значений.',
    ],
    'boolean'              => ':attribute допускает только истину или ложь.',
    'confirmed'            => 'Поле :attribute подтверждение не совпадает.',
    'date'                 => ':attribute не соответствует шаблону даты.',
    'date_format'          => ':attribute не совпадает с форматом :format.',
    'different'            => ':attribute и :other не должны совпадать.',
    'digits'               => ':attribute должен состоять из :digits цифр.',
    'digits_between'       => ':attribute должен содержать от :min до :max цифр.',
    'dimensions'           => ':attribute имеет недопустимые размеры изображения.',
    'distinct'             => ':attribute поле имеет повторяющееся значение.',
    'email'                => ':attribute должен быть валидным E-mail адресом.',
    'exists'               => 'Выбранный :attribute не верный.',
    'file'                 => ':attribute должен содержать файл.',
    'filled'               => ':attribute поле должно содержать значение.',
    'image'                => ':attribute должен содержать изображение.',
    'in'                   => 'Выбранные :attribute не верны.',
    'in_array'             => ':attribute не содержится в :other.',
    'integer'              => ':attribute должен быть цифрой.',
    'ip'                   => ':attribute должен содержать верный IP адрес.',
    'ipv4'                 => ':attribute должен содержать верный IPv4 адрес.',
    'ipv6'                 => 'The :attribute должен содержать верный IPv6 адрес.',
    'json'                 => 'The :attribute должен содержать верную JSON строку.',
    'max'                  => [
        'numeric' => 'Поле :attribute должен быть не больше :max.',
        'file'    => 'Поле :attribute должен быть не больше :max Кб.',
        'string'  => 'Поле :attribute должен быть не больше :max символов.',
        'array'   => 'Поле :attribute должен содержать не больше :max значений.',
    ],
    'mimes'                => ':attribute может содержать только: :values.',
    'mimetypes'            => ':attribute может содержать только: :values.',
    'min'                  => [
        'numeric' => 'Поле :attribute должно быть не менее :min.',
        'file'    => 'Поле :attribute должно быть не менее :min Кб.',
        'string'  => 'Поле :attribute должно быть не менее :min символов.',
        'array'   => 'Поле :attribute должно содержать не менее :min значений.',
    ],
    'not_in'               => 'Выбранные :attribute не верны.',
    'numeric'              => ':attribute должен содержать цифры.',
    'present'              => ':attribute поле должно присутствовать.',
    'regex'                => ':attribute формат не верный.',
    'required'             => 'Поле ":attribute" обязательно к заполнению.',
    'required_if'          => ':attribute обязательно, когда :other имеет значение :value.',
    'required_unless'      => ':attribute обязатедльно пока :other имеет значение :values.',
    'required_with'        => ':attribute обязательно, если :values присутствуют.',
    'required_with_all'    => ':attribute обязательно, если :values присутствуют.',
    'required_without'     => ':attribute обязательно, если :values не присутствует.',
    'required_without_all' => ':attribute обязательно, если :values не присытствуют.',
    'same'                 => ':attribute и :other должны совпадать.',
    'size'                 => [
        'numeric' => ':attribute должен быть :size.',
        'file'    => ':attribute должен быть :size Кб.',
        'string'  => 'The :attribute должен быть :size символов.',
        'array'   => 'The :attribute должен содержать :size значений.',
    ],
    'string'               => ':attribute должен быть строкой.',
    'timezone'             => ':attribute должен содержать временную зону.',
    'unique'               => ':attribute уже есть в базе. Подберите уникальное значение.',
    'uploaded'             => ':attribute не удалось загрузить.',
    'url'                  => ':attribute формат не верный.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];

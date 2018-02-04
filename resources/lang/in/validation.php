<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    |  following language lines contain  default error messages used by
    |  validator class. Some of se rules have multiple versions such
    | as  size rules. Feel free to tweak each of se messages here.
    |
    */

    'accepted'             => ' :attribute harus terkonfirmasi.',
    'active_url'           => ' :attribute URL ini tidak valid.',
    'after'                => ' :attribute harus tanggal setelah :date.',
    'after_or_equal'       => ' :attribute harus tanggal setelah atau setara :date.',
    'alpha'                => ' :attribute hanya dapat berisi huruf.',
    'alpha_dash'           => ' :attribute hanya dapat berisi huruf, nomor, dan garis.',
    'alpha_num'            => ' :attribute hanya dapat berisi huruf dan nomor.',
    'array'                => ' :attribute harus array',
    'before'               => ' :attribute harus tanggal sebelum :date.',
    'before_or_equal'      => ' :attribute harus tanggal sebelum atau setara :date.',
    'between'              => [
        'numeric' => ' :attribute harus diantara :min dan :max.',
        'file'    => ' :attribute harus diantara :min dan :max kilobyte.',
        'string'  => ' :attribute harus diantara :min dan :max karakter.',
        'array'   => ' :attribute harus diantara :min dan :max item.',
    ],
    'boolean'              => ' field :attribute harus bernilai true atau false.',
    'confirmed'            => ' :attribute konfirmasi tidak sesuai.',
    'date'                 => ' :attribute tanggal ini tidak valid.',
    'date_format'          => ' :attribute tidak sama dengan format :format.',
    'different'            => ' :attribute dan :or harus berbeda.',
    'digits'               => ' :attribute harus :digits digit.',
    'digits_between'       => ' :attribute harus diantara :min dan :max digit.',
    'dimensions'           => ' :attribute mempunyai gambar dimensi yang tidak valid.',
    'distinct'             => ' field :attribute mempunyai nilai yang berduplikat.',
    'email'                => ' alamat :attribute harus valid.',
    'exists'               => ' pilihan :attribute tidak valid.',
    'file'                 => ' :attribute harus file.',
    'filled'               => ' field :attribute harus memiliki nilai.',
    'image'                => ' :attribute harus gambar.',
    'in'                   => ' pilihan :attribute tidak valid.',
    'in_array'             => ' field :attribute tidak ada di dalam :or.',
    'integer'              => ' :attribute harus angka.',
    'ip'                   => ' :attribute harus IP address yang valid.',
    'ipv4'                 => ' :attribute harus IPv4 address yang valid.',
    'ipv6'                 => ' :attribute harus IPv6 address yang valid.',
    'json'                 => ' :attribute harus JSON string yang valid.',
    'max'                  => [
        'numeric' => ' :attribute tidak dapat lebih besar dari :max.',
        'file'    => ' :attribute tidak dapat lebih besar dari :max kilobyte.',
        'string'  => ' :attribute tidak dapat lebih besar dari :max karakter.',
        'array'   => ' :attribute tidak dapat lebih besar dari :max item.',
    ],
    'mimes'                => ' :attribute harus file bertipe: :values.',
    'mimetypes'            => ' :attribute harus file bertipe: :values.',
    'min'                  => [
        'numeric' => ' :attribute tidak dapat kurang dari :min.',
        'file'    => ' :attribute tidak dapat kurang dari :min kilobyte.',
        'string'  => ' :attribute tidak dapat kurang dari :min karakter.',
        'array'   => ' :attribute tidak dapat kurang dari :min item.',
    ],
    'not_in'               => ' pilihan :attribute tidak valid.',
    'numeric'              => ' :attribute harus nomor.',
    'present'              => ' field :attribute harus present.',
    'regex'                => ' format :attribute tidak valid.',
    'required'             => ' field :attribute dibutuhkan.',
    'required_if'          => ' field :attribute dibutuhkan jika :or adalah :value.',
    'required_unless'      => ' :attribute field is required unless :or is in :values.',
    'required_with'        => ' :attribute field is required when :values is present.',
    'required_with_all'    => ' :attribute field is required when :values is present.',
    'required_without'     => ' :attribute field is required when :values is not present.',
    'required_without_all' => ' :attribute field is required when none of :values are present.',
    'same'                 => ' :attribute dan :or harus match.',
    'size'                 => [
        'numeric' => ' :attribute harus be :size.',
        'file'    => ' :attribute harus be :size kilobytes.',
        'string'  => ' :attribute harus be :size characters.',
        'array'   => ' :attribute harus contain :size items.',
    ],
    'string'               => ' :attribute harus be a string.',
    'timezone'             => ' :attribute harus be a valid zone.',
    'unique'               => ' :attribute has already been taken.',
    'uploaded'             => ' :attribute failed to upload.',
    'url'                  => ' :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using 
    | convention "attribute.rule" to name  lines. This makes it quick to
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
    |  following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];

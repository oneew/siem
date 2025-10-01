<?php

/**
 * This file contains the Indonesian language translations for validation messages.
 * It overrides the core validation messages or defines custom validation messages.
 */

return [
    // Core validation messages
    'required'             => 'Bidang {field} wajib diisi.',
    'isset'                => 'Bidang {field} harus memiliki nilai.',
    'valid_email'          => 'Bidang {field} harus berisi alamat email yang valid.',
    'valid_emails'         => 'Bidang {field} harus berisi semua alamat email yang valid.',
    'valid_url'            => 'Bidang {field} harus berisi URL yang valid.',
    'valid_ip'             => 'Bidang {field} harus berisi IP yang valid.',
    'min_length'           => 'Bidang {field} harus memiliki panjang minimal {param} karakter.',
    'max_length'           => 'Bidang {field} tidak boleh melebihi {param} karakter.',
    'exact_length'         => 'Bidang {field} harus tepat {param} karakter.',
    'alpha'                => 'Bidang {field} hanya boleh berisi karakter alfabet.',
    'alpha_numeric'        => 'Bidang {field} hanya boleh berisi karakter alfanumerik.',
    'alpha_numeric_spaces' => 'Bidang {field} hanya boleh berisi karakter alfanumerik dan spasi.',
    'alpha_dash'           => 'Bidang {field} hanya boleh berisi karakter alfanumerik, garis bawah, dan tanda hubung.',
    'numeric'              => 'Bidang {field} harus berisi angka.',
    'integer'              => 'Bidang {field} harus berisi bilangan bulat.',
    'decimal'              => 'Bidang {field} harus berisi angka desimal.',
    'less_than'            => 'Bidang {field} harus berisi angka kurang dari {param}.',
    'greater_than'         => 'Bidang {field} harus berisi angka lebih dari {param}.',
    'less_than_equal_to'   => 'Bidang {field} harus berisi angka kurang dari atau sama dengan {param}.',
    'greater_than_equal_to' => 'Bidang {field} harus berisi angka lebih dari atau sama dengan {param}.',
    'equals'               => 'Bidang {field} harus sama dengan {param}.',
    'not_equals'           => 'Bidang {field} tidak boleh sama dengan {param}.',
    'matches'              => 'Bidang {field} tidak cocok dengan bidang {param}.',
    'differs'              => 'Bidang {field} harus berbeda dari bidang {param}.',
    'is_unique'            => 'Bidang {field} harus berisi nilai unik.',
    'is_natural'           => 'Bidang {field} hanya boleh berisi angka.',
    'is_natural_no_zero'   => 'Bidang {field} hanya boleh berisi angka dan harus lebih besar dari nol.',
    'valid_base64'         => 'Bidang {field} harus berisi string base64 yang valid.',
    'min_length'           => 'Bidang {field} harus memiliki panjang minimal {param} karakter.',
    'max_length'           => 'Bidang {field} tidak boleh melebihi {param} karakter.',
    'exact_length'         => 'Bidang {field} harus tepat {param} karakter.',

    // Custom validation messages for the application
    'username_exists'      => 'Nama pengguna sudah digunakan. Silakan pilih nama pengguna lain.',
    'email_exists'         => 'Alamat email sudah terdaftar. Silakan gunakan alamat email lain.',
    'invalid_credentials'  => 'Nama pengguna atau kata sandi tidak valid.',
    'account_inactive'     => 'Akun Anda tidak aktif. Silakan hubungi administrator.',
];

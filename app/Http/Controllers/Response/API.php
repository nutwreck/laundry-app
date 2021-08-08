<?php

namespace App\Http\Controllers\Response;

use App\Http\Controllers\Controller;

class API extends Controller
{
    /* 200 OK
    Response code ini menandakan bahwa request yang dilakukan berhasil.
    201 Created
    Response code ini menandakan bahwa request yang dilakukan berhasil dan data telah dibuat. Kode ini digunakan untuk mengkonfirmasi berhasilnya request PUT atau POST.
    400 Bad Request
    Response code ini menandakan bahwa request yang dibuat salah atau data yang dikirim tidak ada.
    401 Unauthorized
    Response code ini menandakan bahwa request yang dibuat membutuhkan authentication sebelum mengakses resource.
    404 Not Found
    Response Code ini menandakan bahwa resource yang di dipanggil tidak ditemukan.
    405 Method Not Allowed
    Response code ini menandakan bahwa request endpoint ada tetapi metode HTTP yang digunakan tidak diizinkan.
    409 Conflict
    Response code ini menandakan bahwa request yang dibuat terdapat duplikasi, biasanya informasi yang dikirim sudah ada sebelumnya.
    500 Internal Server Error
    Response code ini menandakan bahwa request yang dilakukan terdapat kesalahan pada sisi server atau resource. */

    /* Jika server berhasil eksekusi pengambilan data dari database */
    protected function respondGetSuccess($message, $data)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data
        ], 200);
    }

    /* Jika request buat / update data sukses dieksekusi oleh server */
    protected function respondActionRequest($message)
    {
        return response()->json([
            'success' => true,
            'message' => $message
        ], 201);
    }

    /* Jika request login sukses dieksekusi server | server membuat token untuk user */
    protected function respondLoginSuccess($message, $token)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'token'   => (string) $token
        ], 200);
    }

    /* Jika terdapat kesalahan dari sisi server */
    protected function respondInternalError($message)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], 500);
    }

    /* Jika request yang dikirim tidak menyertakan token */
    protected function respondUnauthorized($message)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], 401);
    }

    /* Jika request yang dikirim tidak berhasil dieksekusi server */
    protected function respondInvalidRequest($message)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], 200);
    }

    /* Jika request yang dikirim berhasil dieksekusi server */
    protected function respondSuccessRequest($message)
    {
        return response()->json([
            'success' => true,
            'message' => $message
        ], 200);
    }

    /* Jika parameter request yang dikirim ke server tidak sesuai */
    protected function respondBadRequest($message)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], 400);
    }

    /* jika terdapat duplikasi data */
    protected function respondConflictRequest($message)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], 409);
    }
}

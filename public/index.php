<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../api/postRepo.php';
require_once __DIR__ . '/../api/userRepo.php';

use App\Config\Database;
use App\Api\postRepo;
use App\Api\userRepo;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$dbConnection = (new Database())->connect();

if ($dbConnection === null) {
    http_response_code(500);
    echo json_encode(["message" => 'Database connection failed.']);
    exit();
}

$postRepo = new postRepo($dbConnection);
$userRepo = new userRepo($dbConnection);

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_uri) {
    case '/api/login':
        if ($request_method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $user = $userRepo->findByEmail($data['email'] ?? '');

            if ($user && password_verify($data['password'] ?? '', $user['password'])) {
                $secret_key = "SENIN_COK_GUVENLI_VE_RASTGELE_ANAHTARIN";
                $issuer_claim = "http://aybek.one";
                $issuedat_claim = time();
                $expire_claim = $issuedat_claim + 3600;

                $payload = [
                    "iss" => $issuer_claim,
                    "aud" => $issuer_claim,
                    "iat" => $issuedat_claim,
                    "exp" => $expire_claim,
                    "data" => [
                        "id" => $user['id'],
                        "email" => $user['email'],
                        "role" => $user['role']
                    ]
                ];
                $jwt = JWT::encode($payload, $secret_key, 'HS256');
                http_response_code(200);
                echo json_encode(["message" => "Giriş başarılı.", "token" => $jwt, "expiresAt" => $expire_claim]);
            } else {
                http_response_code(401);
                echo json_encode(['message' => 'Giriş başarısız. Lütfen bilgilerinizi kontrol edin.']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Bu endpoint sadece POST metodunu kabul eder.']);
        }
        break;

    case '/api/posts':
        switch ($request_method) {
            case 'GET':
                $posts = $postRepo->findAllPublished();
                echo json_encode($posts);
                break;
            
            case 'POST':
                $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;
                if (!$authHeader) {
                    http_response_code(401);
                    echo json_encode(['message' => 'Erişim yetkisi reddedildi. Token bulunamadı.']);
                    exit();
                }

                $token = null;
                if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
                    $token = $matches[1];
                }

                if (!$token) {
                    http_response_code(401);
                    echo json_encode(['message' => 'Erişim yetkisi reddedildi. Token formatı hatalı.']);
                    exit();
                }

                try {
                    $secret_key = "SENIN_COK_GUVENLI_VE_RASTGELE_ANAHTARIN";
                    $decoded = JWT::decode($token, new Key($secret_key, 'HS256'));
                    
                    if ($decoded->data->role !== 'admin') {
                        http_response_code(403);
                        echo json_encode(['message' => 'Erişim yasaklandı. Bu işlemi yapma yetkiniz yok.']);
                        exit();
                    }
                } catch (Exception $e) {
                    http_response_code(401);
                    echo json_encode(['message' => 'Erişim yetkisi reddedildi. Geçersiz token.', 'error' => $e->getMessage()]);
                    exit();
                }

                $data = json_decode(file_get_contents("php://input"), true);
                if (empty($data['title']) || empty($data['slug']) || empty($data['content'])) {
                    http_response_code(400);
                    echo json_encode(['message' => 'Eksik alanlar. title, slug ve content zorunludur.']);
                    exit();
                }

                $newPostId = $postRepo->create($data);
                if ($newPostId) {
                    http_response_code(201);
                    echo json_encode(['message' => 'Yazı başarıyla oluşturuldu.', 'id' => $newPostId]);
                } else {
                    http_response_code(500);
                    echo json_encode(['message' => 'Yazı oluşturulurken bir hata oluştu.']);
                }
                break;
            
            default:
                http_response_code(405);
                echo json_encode(['message' => 'Metoda izin verilmedi.']);
                break;
        }
        break;

    default:
        if (preg_match('/^\/api\/posts\/([a-zA-Z0-9-]+)$/', $request_uri, $matches)) {
            if ($request_method === 'GET') {
                $slug = $matches[1];
                $post = $postRepo->findBySlug($slug);
                if ($post) {
                    echo json_encode($post);
                } else {
                    http_response_code(404);
                    echo json_encode(['message' => 'Yazı bulunamadı.']);
                }
            } else {
                 http_response_code(405);
                 echo json_encode(['message' => 'Bu endpoint sadece GET metodunu kabul eder.']);
            }
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Endpoint bulunamadı.']);
        }
        break;
}
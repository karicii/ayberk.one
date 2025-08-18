<?php
declare(strict_types=1);


require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../api/postRepo.php';

use App\Config\Database;
use App\Api\postRepo;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$dbConnection = (new Database())->connect();

if ($dbConnection === null) {
    http_response_code(500);
    echo json_encode(["message" => 'Database connection failed']);
    exit();
}

// Veri katmanımız olan postRepo'yu veritabanı bağlantısıyla başlatıyoruz.
$postRepo = new postRepo($dbConnection);


$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
$request_method = $_SERVER['REQUEST_METHOD'];


switch ($request_uri) {
    case '/api/posts':
        switch ($request_method) {
            case 'GET':
                $posts = $postRepo->findAllPublished();
                echo json_encode($posts);
                break;
            
            case 'POST':
                $data = json_decode(file_get_contents("php://input"), true);

                if (empty($data['title']) || empty($data['slug']) || empty($data['content'])) {
                    http_response_code(400); // Bad Request
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
                http_response_code(405); // Method Not Allowed
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
                 echo json_encode(['message' => 'Metoda izin verilmedi.']);
            }
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Endpoint bulunamadı.']);
        }
        break;
}
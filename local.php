case 'POST':
                // --- YENİ GÜVENLİK KONTROLÜ BAŞLANGICI ---
                
                // 1. Authorization başlığını al
                $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;

                if (!$authHeader) {
                    http_response_code(401);
                    echo json_encode(['message' => 'Erişim yetkisi reddedildi. Token bulunamadı.']);
                    exit();
                }

                // 2. Token'ı 'Bearer ' kısmından ayır
                $token = null;
                if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
                    $token = $matches[1];
                }

                if (!$token) {
                    http_response_code(401);
                    echo json_encode(['message' => 'Erişim yetkisi reddedildi. Token formatı hatalı.']);
                    exit();
                }

                // 3. Token'ı doğrula
                try {
                    $secret_key = "SENIN_COK_GUVENLI_VE_RASTGELE_ANAHTARIN";
                    $decoded = JWT::decode($token, new \Firebase\JWT\Key($secret_key, 'HS256'));
                    
                    // İsteğe bağlı: Sadece 'admin' rolündekiler yazı ekleyebilsin
                    if ($decoded->data->role !== 'admin') {
                        http_response_code(403); // Forbidden
                        echo json_encode(['message' => 'Erişim yasaklandı. Bu işlemi yapma yetkiniz yok.']);
                        exit();
                    }

                } catch (Exception $e) {
                    http_response_code(401);
                    echo json_encode(['message' => 'Erişim yetkisi reddedildi. Geçersiz token.', 'error' => $e->getMessage()]);
                    exit();
                }

                // --- YENİ GÜVENLİK KONTROLÜ BİTİŞİ ---


                // Güvenlikten geçtiyse, yazı oluşturma kodumuz çalışır
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
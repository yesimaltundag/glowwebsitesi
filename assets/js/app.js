// ===== ANGULAR APP MODULE =====
angular
  .module("GirisApp", [])
  .config(function ($qProvider) {
    $qProvider.errorOnUnhandledRejections(false);
  })
  .filter("yildizSistemi", function ($sce) {
    return function (puan) {
      if (!puan || puan < 0 || puan > 10) return "";

      var yildizlar = "";
      var tamYildiz = Math.floor(puan);

      // Mavi yıldızlar (verilen puan kadar)
      for (var i = 0; i < tamYildiz; i++) {
        yildizlar += '<span class="yildiz mavi"></span>';
      }

      // Gri yıldızlar (kalan)
      for (var i = tamYildiz; i < 10; i++) {
        yildizlar += '<span class="yildiz gri"></span>';
      }

      return $sce.trustAsHtml(
        yildizlar +
          ' <span style="margin-left: 5px; font-size: 0.9rem; color: #e67e22;">(' +
          puan +
          "/10)</span>"
      );
    };
  })

  // ===== MAIN CONTROLLER =====
  .controller("MainController", function ($scope, $http) {
    // Kullanıcı durumu kontrolü
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");

    // Sayfa başlığı
    $scope.pageTitle = "GLOW";

    // Scroll to top fonksiyonu
    $scope.scrollToTop = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };
  })

  // ===== HEADER CONTROLLER =====
  .controller("HeaderController", function ($scope, $http) {
    // Kullanıcı durumu kontrolü
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");

    // Çıkış yapma fonksiyonu
    $scope.cikisYap = function () {
      localStorage.removeItem("girisYapan");
      $scope.kullanici = null;
      window.location.href = "index.html";
    };

    $scope.hesapGit = function ($event) {
      $event.preventDefault();
      if (
        $scope.kullanici &&
        ($scope.kullanici.rol === "admin" ||
          $scope.kullanici.rol === "Yönetici")
      ) {
        window.location.href = "liste.html";
      } else {
        window.location.href = "profil.html";
      }
    };

    // Scroll to top fonksiyonu
    $scope.scrollToTop = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };
  })

  // ===== LOGIN CONTROLLER =====
  .controller("GirisController", function ($scope, $http) {
    $scope.formData = {
      username: "",
      password: "",
    };

    $scope.girisYap = function () {
      console.log("🔐 Giriş yapılıyor...");
      console.log("📤 Gönderilen veri:", {
        username: $scope.formData.username,
        sifre: $scope.formData.password,
      });

      $http
        .post("api.php?login=1", {
          username: $scope.formData.username,
          sifre: $scope.formData.password,
        })
        .then(function (response) {
          console.log("📥 API yanıtı:", response);
          console.log("📊 Response data:", response.data);

          if (response.data.success) {
            console.log("✅ Giriş başarılı!");
            localStorage.setItem(
              "girisYapan",
              JSON.stringify(response.data.kullanici)
            );
            console.log("👤 Kullanıcı bilgileri:", response.data.kullanici);

            if (
              response.data.kullanici.rol === "admin" ||
              response.data.kullanici.rol === "Yönetici"
            ) {
              console.log("👑 Admin olarak yönlendiriliyor...");
              window.location.href = "liste.html";
            } else {
              console.log("👤 Normal kullanıcı olarak yönlendiriliyor...");
              window.location.href = "anasayfa.html";
            }
          } else {
            console.log("❌ Giriş başarısız:", response.data.message);
            alert("Giriş başarısız: " + response.data.message);
          }
        })
        .catch(function (error) {
          console.error("❌ Giriş hatası:", error);
          console.error("🔍 Error details:", {
            status: error.status,
            statusText: error.statusText,
            data: error.data,
            config: error.config,
          });

          if (error.data && error.data.message) {
            alert("Bir hata oluştu: " + error.data.message);
          } else {
            alert("Sunucu bağlantı hatası! Lütfen tekrar deneyin.");
          }
        });
    };
  })

  // ===== REGISTER CONTROLLER =====
  .controller("KayitController", function ($scope, $http) {
    $scope.kayitOl = function () {
      if ($scope.sifre.length < 6 || $scope.sifre.length > 10) {
        alert("Şifre 6 ile 10 karakter arasında olmalıdır!");
        return;
      }

      $http
        .post("api.php?kayit=1", {
          username: $scope.username,
          adsoyad: $scope.adsoyad,
          sifre: $scope.sifre,
          eposta: $scope.eposta,
          rol: "kullanici",
        })
        .then(function (response) {
          if (response.data.success) {
            alert("Kayıt başarılı! Giriş yapabilirsiniz.");
            window.location.href = "index.html";
          } else {
            alert("Kayıt işlemi başarısız: " + response.data.message);
          }
        })
        .catch(function (error) {
          console.error("Kayıt hatası:", error);
          if (error.data && error.data.message) {
            alert("Bir hata oluştu: " + error.data.message);
          } else {
            alert("Sunucu bağlantı hatası! Lütfen tekrar deneyin.");
          }
        });
    };
  })

  // ===== HOMEPAGE CONTROLLER =====
  .controller("AnasayfaController", function ($scope, $http) {
    console.log("🏠 AnasayfaController başlatıldı");
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");
    $scope.sonYorumlar = [];
    $scope.yorumlarLoading = true;

    console.log("🏠 Başlangıç durumu:", {
      kullanici: $scope.kullanici,
      sonYorumlar: $scope.sonYorumlar,
      yorumlarLoading: $scope.yorumlarLoading,
    });

    // Son yorumları getir
    $scope.sonYorumlariGetir = function () {
      console.log("🏠 Anasayfa: Son yorumlar getiriliyor...");
      $scope.yorumlarLoading = true;
      $http
        .get("api.php?son_yorumlar=1&limit=6")
        .then(function (response) {
          console.log("📥 Anasayfa API yanıtı:", response);
          console.log(
            "📊 Gelen yorum sayısı:",
            response.data ? response.data.length : 0
          );
          $scope.sonYorumlar = response.data || [];
          console.log("📊 Scope'daki son yorumlar:", $scope.sonYorumlar);
          $scope.yorumlarLoading = false;
          // Angular'ın değişiklikleri algılamasını sağla
          $scope.$apply();
        })
        .catch(function (error) {
          console.error("❌ Anasayfa: Son yorumlar yüklenirken hata:", error);
          $scope.sonYorumlar = [];
          $scope.yorumlarLoading = false;
          // Angular'ın değişiklikleri algılamasını sağla
          $scope.$apply();
        });
    };

    // Debug: Tüm yorumları kontrol et
    $scope.debugYorumlar = function () {
      console.log("🔍 Debug: Tüm yorumlar kontrol ediliyor...");
      $http
        .get("api.php?tum_yorumlar=1")
        .then(function (response) {
          console.log("📊 Tüm yorumlar:", response.data);
          console.log(
            "📊 Toplam yorum sayısı:",
            response.data ? response.data.length : 0
          );

          // Eğer yorumlar varsa, son yorumları da güncelle
          if (response.data && response.data.length > 0) {
            console.log("🔄 Son yorumları güncelliyorum...");
            $scope.sonYorumlar = response.data.slice(0, 6); // İlk 6 yorumu al
            $scope.yorumlarLoading = false;
            $scope.$apply();
            alert(
              "Toplam " +
                response.data.length +
                " yorum bulundu. Son yorumlar güncellendi!"
            );
          } else {
            alert("Hiç yorum bulunamadı. Console'u kontrol edin.");
          }
        })
        .catch(function (error) {
          console.error("❌ Debug hatası:", error);
          alert("Debug hatası: " + error.statusText);
        });
    };

    // Manuel test: Yorumları zorla göster
    $scope.manuelTestYorumlar = function () {
      console.log("🧪 Manuel test başlatılıyor...");
      console.log("🧪 Önceki durum:", {
        sonYorumlar: $scope.sonYorumlar,
        yorumlarLoading: $scope.yorumlarLoading,
      });

      // Test verisi oluştur
      var testYorumlar = [
        {
          id: 1,
          kullanici_id: 1,
          kullanici_adi: "Test Kullanıcı",
          tur: "tiyatro",
          icerik_id: 1,
          icerik_adi: "Test Tiyatro Eseri",
          yorum: "Bu bir test yorumudur. Tiyatro eseri gerçekten harika!",
          puan: 8,
          created_at: new Date().toISOString(),
        },
        {
          id: 2,
          kullanici_id: 1,
          kullanici_adi: "Test Kullanıcı 2",
          tur: "film",
          icerik_id: 1,
          icerik_adi: "Test Film",
          yorum: "Bu da ikinci test yorumudur. Film çok güzel!",
          puan: 9,
          created_at: new Date().toISOString(),
        },
      ];

      console.log("🧪 Test yorumları:", testYorumlar);

      // Scope'u güncelle
      $scope.sonYorumlar = testYorumlar;
      $scope.yorumlarLoading = false;

      console.log("🧪 Güncelleme sonrası:", {
        sonYorumlar: $scope.sonYorumlar,
        yorumlarLoading: $scope.yorumlarLoading,
      });

      // Angular'ı zorla güncelle
      $scope.$apply();

      // DOM'u kontrol et
      setTimeout(function () {
        var yorumlarGrid = document.querySelector(".yorumlar-grid");
        var yorumYok = document.querySelector(".yorum-yok");
        console.log("🧪 DOM durumu:", {
          yorumlarGrid: yorumlarGrid,
          yorumYok: yorumYok,
          yorumlarGridVisible:
            yorumlarGrid && yorumlarGrid.style.display !== "none",
          yorumYokVisible: yorumYok && yorumYok.style.display !== "none",
        });
      }, 100);

      alert("Test yorumları eklendi! Console'u kontrol edin.");
    };

    // Yorum detayına git
    $scope.yorumDetayinaGit = function (yorum) {
      var sayfa = "";
      switch (yorum.tur) {
        case "film":
          sayfa = "film-detay.html?id=" + yorum.icerik_id;
          break;
        case "dizi":
          sayfa = "dizi-detay.html?id=" + yorum.icerik_id;
          break;
        case "tiyatro":
          sayfa = "tiyatro-detay.html?id=" + yorum.icerik_id;
          break;
        case "kitap":
          sayfa = "kitap-detay.html?id=" + yorum.icerik_id;
          break;
        default:
          sayfa = "anasayfa.html";
      }
      window.location.href = sayfa;
    };

    $scope.gotoYazilar = function () {
      window.location.href = "yazilar.html";
    };
    $scope.gotoKitaplar = function () {
      window.location.href = "kitaplar.html";
    };
    $scope.gotoSeyahat = function () {
      window.location.href = "seyahat.html";
    };
    $scope.gotoShow = function () {
      window.location.href = "show.html";
    };
    $scope.gotoSanat = function () {
      window.location.href = "sanat-kategoriler.html";
    };
    $scope.gotoSpor = function () {
      window.location.href = "spor.html";
    };
    $scope.gotoYemekler = function () {
      window.location.href = "yemekler.html";
    };

    // Sayfa yüklendiğinde son yorumları getir
    $scope.sonYorumlariGetir();
  })

  // ===== ABOUT CONTROLLER =====
  .controller("HakkimizdaController", function ($scope) {
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");
  })

  // ===== CONTACT CONTROLLER =====
  .controller("IletisimController", function ($scope) {
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");
  })

  // ===== PROFILE CONTROLLER =====
  .controller("ProfilController", function ($scope, $http) {
    // Kullanıcı kontrolü
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");

    if (!$scope.kullanici || !$scope.kullanici.id) {
      alert("Giriş yapılmamış. Lütfen tekrar giriş yapın.");
      window.location.href = "index.html";
      return;
    }

    $scope.notuKaydet = function () {
      var gonderilecek = angular.copy($scope.kullanici);

      if ($scope.yeniSifre) {
        if ($scope.yeniSifre.length < 6 || $scope.yeniSifre.length > 10) {
          return;
        }
        gonderilecek.sifre = $scope.yeniSifre;
      } else {
        delete gonderilecek.sifre;
      }

      $http
        .put("api.php", gonderilecek)
        .then(function (response) {
          if (response.data.success) {
            localStorage.setItem(
              "girisYapan",
              JSON.stringify($scope.kullanici)
            );
            $scope.yeniSifre = "";

            setTimeout(function () {
              $scope.yeniSifre = "";
              $scope.$apply();
            }, 3000);
          } else {
            alert("Kaydedilemedi: " + (response.data.message || ""));
          }
        })
        .catch(function (error) {
          console.error("Profil güncelleme hatası:", error);
          if (error.data && error.data.message) {
            alert("Sunucu hatası: " + error.data.message);
          } else {
            alert("Sunucu bağlantı hatası! Lütfen tekrar deneyin.");
          }
        });
    };

    $scope.geriGit = function () {
      window.location.href = "anasayfa.html";
    };

    $scope.cikisYap = function () {
      localStorage.removeItem("girisYapan");
      window.location.href = "anasayfa.html";
    };
  })

  // ===== DIZI KATEGORILER CONTROLLER =====
  .controller("DiziKategorilerController", function ($scope) {
    // Kullanıcı durumu kontrolü
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");

    $scope.kategoriSec = function (kategori) {
      // Kategori adını URL'ye uygun hale getir
      var kategoriUrl = kategori.replace("_", "-");
      window.location.href = kategoriUrl + "-diziler.html";
    };

    $scope.scrollToTop = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };
  })

  // ===== TIYATRO DETAY CONTROLLER =====
  .controller("TiyatroDetayController", function ($scope, $http, $location) {
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");
    $scope.tiyatroEseri = null;
    $scope.loading = true;
    $scope.error = null;
    $scope.yorumlar = [];
    $scope.yeniYorum = {
      yorum: "",
      puan: 0,
    };

    // Puan seçimi için yardımcı fonksiyon
    $scope.puanSec = function (puan) {
      console.log("⭐ Puan seçildi:", puan); // Debug log
      $scope.yeniYorum.puan = parseInt(puan);
      console.log("📊 Güncellenmiş yeni yorum:", $scope.yeniYorum);
      // Angular'ın değişiklikleri algılamasını sağla (sadece gerekirse)
      if (!$scope.$$phase && !$scope.$root.$$phase) {
        $scope.$apply();
      }
    };

    // URL'den ID'yi al
    var urlParams = new URLSearchParams(window.location.search);
    var eserId = urlParams.get("id");
    console.log("🎭 Tiyatro eseri ID'si:", eserId);

    if (!eserId) {
      $scope.error = "Tiyatro eseri ID'si bulunamadı!";
      $scope.loading = false;
      return;
    }

    // Tiyatro eserini getir
    $scope.tiyatroEseriniGetir = function () {
      console.log("🎭 Tiyatro eseri getiriliyor... ID:", eserId);
      $scope.loading = true;
      $scope.error = null;

      $http
        .get("api.php?tiyatro=1&id=" + eserId)
        .then(function (response) {
          console.log("📥 Tiyatro eseri API yanıtı:", response);
          $scope.tiyatroEseri = response.data;
          console.log("🎭 Yüklenen tiyatro eseri:", $scope.tiyatroEseri);
          $scope.loading = false;
          // Eser yüklendikten sonra yorumları getir
          $scope.yorumlariGetir();
        })
        .catch(function (error) {
          console.error("❌ Tiyatro eseri yükleme hatası:", error);
          $scope.error =
            "Tiyatro eseri yüklenirken hata oluştu: " + error.statusText;
          $scope.loading = false;
        });
    };

    // Yorumları getir
    $scope.yorumlariGetir = function () {
      console.log("🔍 Yorumlar getiriliyor... Eser ID:", eserId);
      console.log("🔍 Önceki yorumlar:", $scope.yorumlar);

      $http
        .get("api.php?yorum=1&tur=tiyatro&icerik_id=" + eserId)
        .then(function (response) {
          console.log("📊 API'den gelen yorumlar:", response.data);
          console.log(
            "📊 Yorum sayısı:",
            response.data ? response.data.length : 0
          );
          console.log("📊 Response tam hali:", response);

          $scope.yorumlar = response.data || [];
          console.log("📊 Scope'daki yorumlar:", $scope.yorumlar);
          console.log("📊 Yorumlar array mi?", Array.isArray($scope.yorumlar));
          console.log(
            "📊 Yorumların ID'leri:",
            $scope.yorumlar.map(function (y) {
              return y.id;
            })
          );
          console.log(
            "📊 Yorumların kullanıcı adları:",
            $scope.yorumlar.map(function (y) {
              return y.kullanici_adi;
            })
          );

          // Yorumların tam detaylarını göster
          console.log("📊 Yorumların tam detayları:");
          $scope.yorumlar.forEach(function (yorum, index) {
            console.log("Yorum " + (index + 1) + ":", {
              id: yorum.id,
              kullanici_adi: yorum.kullanici_adi,
              yorum: yorum.yorum,
              puan: yorum.puan,
              created_at: yorum.created_at,
              tur: yorum.tur,
              icerik_id: yorum.icerik_id,
            });

            // Ham veriyi kontrol et
            console.log("Yorum " + (index + 1) + " ham veri:", yorum);
            console.log(
              "Yorum " + (index + 1) + " tüm anahtarlar:",
              Object.keys(yorum)
            );
            console.log(
              "Yorum " + (index + 1) + " tüm anahtarlar detayı:",
              Object.keys(yorum).map(function (key) {
                return key + ": " + yorum[key] + " (" + typeof yorum[key] + ")";
              })
            );

            // Veritabanı alanlarını kontrol et
            console.log("Yorum " + (index + 1) + " veritabanı alanları:");
            console.log("  - id:", yorum.id, "(" + typeof yorum.id + ")");
            console.log(
              "  - kullanici_id:",
              yorum.kullanici_id,
              "(" + typeof yorum.kullanici_id + ")"
            );
            console.log(
              "  - kullanici_adi:",
              yorum.kullanici_adi,
              "(" + typeof yorum.kullanici_adi + ")"
            );
            console.log("  - tur:", yorum.tur, "(" + typeof yorum.tur + ")");
            console.log(
              "  - icerik_id:",
              yorum.icerik_id,
              "(" + typeof yorum.icerik_id + ")"
            );
            console.log(
              "  - icerik_adi:",
              yorum.icerik_adi,
              "(" + typeof yorum.icerik_adi + ")"
            );
            console.log(
              "  - yorum:",
              yorum.yorum,
              "(" + typeof yorum.yorum + ")"
            );
            console.log("  - puan:", yorum.puan, "(" + typeof yorum.puan + ")");
            console.log(
              "  - created_at:",
              yorum.created_at,
              "(" + typeof yorum.created_at + ")"
            );
          });

          // Angular'ın değişiklikleri algılamasını sağla (sadece gerekirse)
          if (!$scope.$$phase && !$scope.$root.$$phase) {
            $scope.$apply();
          }

          // DOM'u kontrol et
          setTimeout(function () {
            var yorumlarListe = document.querySelector(".yorumlar-liste");
            var yorumYok = document.querySelector(".yorum-yok");
            console.log("🎭 DOM durumu:", {
              yorumlarListe: yorumlarListe,
              yorumYok: yorumYok,
              yorumlarListeVisible:
                yorumlarListe && yorumlarListe.style.display !== "none",
              yorumYokVisible: yorumYok && yorumYok.style.display !== "none",
            });
          }, 100);
        })
        .catch(function (error) {
          console.error("❌ Yorumlar yüklenirken hata:", error);
          console.error("❌ Hata detayı:", error.data);
          $scope.yorumlar = [];
          if (!$scope.$$phase && !$scope.$root.$$phase) {
            $scope.$apply();
          }
        });
    };

    // Yorum ekle
    $scope.yorumEkle = function () {
      console.log("🚀 Yorum ekleme fonksiyonu çağrıldı");
      console.log("👤 Kullanıcı:", $scope.kullanici);
      console.log("📝 Yeni yorum:", $scope.yeniYorum);
      console.log("🎭 Tiyatro eseri:", $scope.tiyatroEseri);
      console.log("🆔 Eser ID:", eserId);

      if (!$scope.kullanici) {
        alert("Yorum yapmak için giriş yapmalısınız!");
        return;
      }

      if (!$scope.yeniYorum.yorum || $scope.yeniYorum.yorum.length < 10) {
        alert("Yorum en az 10 karakter olmalıdır!");
        return;
      }

      if (!$scope.yeniYorum.puan || $scope.yeniYorum.puan < 1) {
        alert("Lütfen bir puan seçin!");
        return;
      }

      if (!$scope.tiyatroEseri || !$scope.tiyatroEseri.eser_adi) {
        alert("Tiyatro eseri bilgisi yüklenemedi!");
        return;
      }

      var yorumData = {
        kullanici_id: $scope.kullanici.id,
        kullanici_adi: $scope.kullanici.username,
        tur: "tiyatro",
        icerik_id: eserId,
        icerik_adi: $scope.tiyatroEseri.eser_adi,
        yorum: $scope.yeniYorum.yorum,
        puan: $scope.yeniYorum.puan,
      };

      console.log("📤 Gönderilecek veri:", yorumData);

      $http
        .post("api.php?yorum=1", yorumData)
        .then(function (response) {
          console.log("📥 API yanıtı:", response);
          if (response.data.success) {
            alert("Yorum başarıyla eklendi!");
            // Formu temizle
            $scope.yeniYorum = {
              yorum: "",
              puan: 0,
            };
            // Yorumları yeniden yükle
            $scope.yorumlariGetir();
            // Sayfayı yenile (güvenlik için)
            setTimeout(function () {
              location.reload();
            }, 1000);
          } else {
            alert("Yorum eklenirken hata: " + response.data.message);
          }
        })
        .catch(function (error) {
          console.error("❌ Yorum ekleme hatası:", error);
          console.error("❌ Hata detayı:", error.data);
          alert("Yorum eklenirken hata oluştu: " + error.statusText);
        });
    };

    // Test yorum ekleme fonksiyonu
    $scope.testYorumEkle = function () {
      console.log("🧪 Test yorum ekleme başlatılıyor...");

      // Test verisi
      $scope.yeniYorum = {
        yorum: "Bu bir test yorumudur. Tiyatro eseri gerçekten harika!",
        puan: 8,
      };

      console.log("🧪 Test verisi hazırlandı:", $scope.yeniYorum);

      // Yorum ekleme fonksiyonunu çağır
      $scope.yorumEkle();
    };

    // Debug yorumlar fonksiyonu
    $scope.debugYorumlar = function () {
      console.log("🔍 Debug: Yorumlar kontrol ediliyor...");
      console.log("🔍 Mevcut durum:", {
        yorumlar: $scope.yorumlar,
        yorumlarLength: $scope.yorumlar ? $scope.yorumlar.length : 0,
        eserId: eserId,
      });

      // API'den yorumları tekrar getir
      $http
        .get("api.php?yorum=1&tur=tiyatro&icerik_id=" + eserId)
        .then(function (response) {
          console.log("🔍 Debug API yanıtı:", response);
          console.log(
            "🔍 Gelen yorum sayısı:",
            response.data ? response.data.length : 0
          );

          if (response.data && response.data.length > 0) {
            console.log("🔍 İlk yorum örneği:", response.data[0]);
          }

          alert(
            "Debug tamamlandı. Console'u kontrol edin. Yorum sayısı: " +
              (response.data ? response.data.length : 0)
          );
        })
        .catch(function (error) {
          console.error("🔍 Debug hatası:", error);
          alert("Debug hatası: " + error.statusText);
        });
    };

    // Manuel test: Yorumları zorla göster
    $scope.manuelTestYorumlar = function () {
      console.log("🧪 Manuel test başlatılıyor...");

      // Test yorumları oluştur
      var testYorumlar = [
        {
          id: 1,
          kullanici_id: 1,
          kullanici_adi: "Test Kullanıcı",
          tur: "tiyatro",
          icerik_id: eserId,
          icerik_adi: "Test Tiyatro",
          yorum: "Bu bir test yorumudur. Tiyatro eseri harika!",
          puan: 8,
          created_at: new Date().toISOString(),
        },
        {
          id: 2,
          kullanici_id: 1,
          kullanici_adi: "Test Kullanıcı 2",
          tur: "tiyatro",
          icerik_id: eserId,
          icerik_adi: "Test Tiyatro",
          yorum: "İkinci test yorumu. Gerçekten güzel!",
          puan: 9,
          created_at: new Date().toISOString(),
        },
      ];

      console.log("🧪 Test yorumları:", testYorumlar);
      $scope.yorumlar = testYorumlar;
      if (!$scope.$$phase && !$scope.$root.$$phase) {
        $scope.$apply();
      }

      alert("Test yorumları eklendi! Şimdi yorumlar görünmeli.");
    };

    // Yorum sil
    $scope.yorumSil = function (yorumId) {
      if (confirm("Bu yorumu silmek istediğinizden emin misiniz?")) {
        $http({
          method: "DELETE",
          url:
            "api.php?yorum=1&id=" +
            yorumId +
            "&kullanici_id=" +
            $scope.kullanici.id,
        })
          .then(function (response) {
            if (response.data.success) {
              alert("Yorum başarıyla silindi!");
              $scope.yorumlariGetir();
            } else {
              alert("Yorum silinirken hata: " + response.data.message);
            }
          })
          .catch(function (error) {
            alert("Yorum silinirken hata oluştu: " + error.statusText);
          });
      }
    };

    // Scroll to top fonksiyonu
    $scope.scrollToTop = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };

    // Sayfa yüklendiğinde eseri getir
    $scope.tiyatroEseriniGetir();
  })

  // ===== TIYATRO CONTROLLER =====
  .controller("TiyatroController", function ($scope, $http) {
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");
    $scope.tiyatroEserleri = [];
    $scope.tiyatroKategorileri = [];
    $scope.seciliKategori = "Tümü";
    $scope.loading = true;
    $scope.error = null;

    // Tiyatro kategorilerini getir
    $scope.kategorileriGetir = function () {
      $http
        .get("api.php?tiyatro=1&kategoriler=1")
        .then(function (response) {
          $scope.tiyatroKategorileri = response.data;
        })
        .catch(function (error) {
          console.error("Kategoriler yüklenirken hata:", error);
        });
    };

    // Tiyatro eserlerini getir
    $scope.tiyatroEserleriniGetir = function (kategori = null) {
      $scope.loading = true;
      $scope.error = null;

      var url = "api.php?tiyatro=1";
      if (kategori && kategori !== "Tümü") {
        url += "&tur=" + encodeURIComponent(kategori);
      }

      $http
        .get(url)
        .then(function (response) {
          $scope.tiyatroEserleri = response.data;
          $scope.enYuksekPuanuHesapla();
          $scope.loading = false;
        })
        .catch(function (error) {
          $scope.error =
            "Tiyatro eserleri yüklenirken hata oluştu: " + error.statusText;
          $scope.loading = false;
        });
    };

    // En yüksek puanı hesapla
    $scope.enYuksekPuanuHesapla = function () {
      if ($scope.tiyatroEserleri && $scope.tiyatroEserleri.length > 0) {
        var enYuksek = Math.max.apply(
          null,
          $scope.tiyatroEserleri.map(function (eser) {
            return parseFloat(eser.puan);
          })
        );
        $scope.enYuksekPuan = enYuksek.toFixed(1);
      } else {
        $scope.enYuksekPuan = "0.0";
      }
    };

    // Kategori eser sayısını hesapla
    $scope.kategoriEserSayisi = function (kategori) {
      if (!$scope.tiyatroEserleri) return 0;
      return $scope.tiyatroEserleri.filter(function (eser) {
        return eser.tur === kategori;
      }).length;
    };

    // Kategori seçimi
    $scope.kategoriSec = function (kategori) {
      $scope.seciliKategori = kategori;
      $scope.tiyatroEserleriniGetir(kategori);
    };

    // Eser detayına git
    $scope.eserDetayGit = function (eserId) {
      window.location.href = "tiyatro-detay.html?id=" + eserId;
    };

    // Scroll to top fonksiyonu
    $scope.scrollToTop = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };

    // Sayfa yüklendiğinde kategorileri ve eserleri getir
    $scope.kategorileriGetir();
    $scope.tiyatroEserleriniGetir();
  })

  // ===== BELGESEL CONTROLLER =====
  .controller("BelgeselController", function ($scope, $http) {
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");
    $scope.belgeseller = [];
    $scope.loading = true;
    $scope.error = null;

    // Belgeselleri getir
    $scope.belgeselleriGetir = function () {
      $scope.loading = true;
      $scope.error = null;

      $http
        .get("api.php?belgesel=1")
        .then(function (response) {
          $scope.belgeseller = response.data;
          $scope.loading = false;
        })
        .catch(function (error) {
          $scope.error =
            "Belgeseller yüklenirken hata oluştu: " + error.statusText;
          $scope.loading = false;
        });
    };

    // Belgesel detayına git
    $scope.belgeselDetayGit = function (belgeselId) {
      window.location.href = "belgesel-detay.html?id=" + belgeselId;
    };

    // Scroll to top fonksiyonu
    $scope.scrollToTop = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };

    // Sayfa yüklendiğinde belgeselleri getir
    $scope.belgeselleriGetir();
  })

  // ===== BELGESEL DETAY CONTROLLER =====
  .controller("BelgeselDetayController", function ($scope, $http, $location) {
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");
    $scope.belgesel = null;
    $scope.loading = true;
    $scope.error = null;
    $scope.yorumlar = [];
    $scope.yeniYorum = {
      yorum: "",
      puan: 0,
    };

    // URL'den ID'yi al
    var urlParams = new URLSearchParams(window.location.search);
    var belgeselId = urlParams.get("id");

    if (!belgeselId) {
      $scope.error = "Belgesel ID'si bulunamadı!";
      $scope.loading = false;
      return;
    }

    // Belgeseli getir
    $scope.belgeseliGetir = function () {
      $scope.loading = true;
      $scope.error = null;

      $http
        .get("api.php?belgesel=1&id=" + belgeselId)
        .then(function (response) {
          $scope.belgesel = response.data;
          $scope.loading = false;
          // Belgesel yüklendikten sonra yorumları getir
          $scope.yorumlariGetir();
        })
        .catch(function (error) {
          $scope.error =
            "Belgesel yüklenirken hata oluştu: " + error.statusText;
          $scope.loading = false;
        });
    };

    // Yorumları getir
    $scope.yorumlariGetir = function () {
      $http
        .get("api.php?yorum=1&tur=belgesel&icerik_id=" + belgeselId)
        .then(function (response) {
          $scope.yorumlar = response.data;
        })
        .catch(function (error) {
          console.error("Yorumlar yüklenirken hata:", error);
        });
    };

    // Yorum ekle
    $scope.yorumEkle = function () {
      if (!$scope.kullanici) {
        alert("Yorum yapmak için giriş yapmalısınız!");
        return;
      }

      if (!$scope.yeniYorum.yorum || $scope.yeniYorum.yorum.length < 10) {
        alert("Yorum en az 10 karakter olmalıdır!");
        return;
      }

      if (!$scope.yeniYorum.puan || $scope.yeniYorum.puan < 1) {
        alert("Lütfen bir puan seçin!");
        return;
      }

      var yorumData = {
        kullanici_id: $scope.kullanici.id,
        kullanici_adi: $scope.kullanici.username,
        tur: "belgesel",
        icerik_id: belgeselId,
        icerik_adi: $scope.belgesel.belgesel_adi,
        yorum: $scope.yeniYorum.yorum,
        puan: $scope.yeniYorum.puan,
      };

      $http
        .post("api.php?yorum=1", yorumData)
        .then(function (response) {
          if (response.data.success) {
            alert("Yorum başarıyla eklendi!");
            // Formu temizle
            $scope.yeniYorum = {
              yorum: "",
              puan: 0,
            };
            // Yorumları yeniden yükle
            $scope.yorumlariGetir();
          } else {
            alert("Yorum eklenirken hata: " + response.data.message);
          }
        })
        .catch(function (error) {
          alert("Yorum eklenirken hata oluştu: " + error.statusText);
        });
    };

    // Yorum sil
    $scope.yorumSil = function (yorumId) {
      if (confirm("Bu yorumu silmek istediğinizden emin misiniz?")) {
        $http({
          method: "DELETE",
          url:
            "api.php?yorum=1&id=" +
            yorumId +
            "&kullanici_id=" +
            $scope.kullanici.id,
        })
          .then(function (response) {
            if (response.data.success) {
              alert("Yorum başarıyla silindi!");
              $scope.yorumlariGetir();
            } else {
              alert("Yorum silinirken hata: " + response.data.message);
            }
          })
          .catch(function (error) {
            alert("Yorum silinirken hata oluştu: " + error.statusText);
          });
      }
    };

    // Scroll to top fonksiyonu
    $scope.scrollToTop = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };

    // Sayfa yüklendiğinde belgeseli getir
    $scope.belgeseliGetir();
  })

  // ===== ANIME CONTROLLER =====
  .controller("AnimeController", function ($scope, $http) {
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");
    $scope.animeler = [];
    $scope.loading = true;
    $scope.error = null;

    // Animeleri getir
    $scope.animeleriGetir = function () {
      $scope.loading = true;
      $scope.error = null;

      $http
        .get("api.php?anime=1")
        .then(function (response) {
          $scope.animeler = response.data;
          $scope.loading = false;
        })
        .catch(function (error) {
          $scope.error =
            "Animeler yüklenirken hata oluştu: " + error.statusText;
          $scope.loading = false;
        });
    };

    // Anime detayına git
    $scope.animeDetayGit = function (animeId) {
      window.location.href = "anime-detay.html?id=" + animeId;
    };

    // Scroll to top fonksiyonu
    $scope.scrollToTop = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };

    // Sayfa yüklendiğinde animeleri getir
    $scope.animeleriGetir();
  })

  // ===== ANIME DETAY CONTROLLER =====
  .controller("AnimeDetayController", function ($scope, $http, $location) {
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");
    $scope.anime = null;
    $scope.loading = true;
    $scope.error = null;
    $scope.yorumlar = [];
    $scope.yeniYorum = {
      yorum: "",
      puan: 0,
    };

    // URL'den ID'yi al
    var urlParams = new URLSearchParams(window.location.search);
    var animeId = urlParams.get("id");

    if (!animeId) {
      $scope.error = "Anime ID'si bulunamadı!";
      $scope.loading = false;
      return;
    }

    // Animeyi getir
    $scope.animeyiGetir = function () {
      $scope.loading = true;
      $scope.error = null;

      $http
        .get("api.php?anime=1&id=" + animeId)
        .then(function (response) {
          $scope.anime = response.data;
          $scope.loading = false;
          // Anime yüklendikten sonra yorumları getir
          $scope.yorumlariGetir();
        })
        .catch(function (error) {
          $scope.error = "Anime yüklenirken hata oluştu: " + error.statusText;
          $scope.loading = false;
        });
    };

    // Yorumları getir
    $scope.yorumlariGetir = function () {
      $http
        .get("api.php?yorum=1&tur=anime&icerik_id=" + animeId)
        .then(function (response) {
          $scope.yorumlar = response.data;
        })
        .catch(function (error) {
          console.error("Yorumlar yüklenirken hata:", error);
        });
    };

    // Yorum ekle
    $scope.yorumEkle = function () {
      if (!$scope.kullanici) {
        alert("Yorum yapmak için giriş yapmalısınız!");
        return;
      }

      if (!$scope.yeniYorum.yorum || $scope.yeniYorum.yorum.length < 10) {
        alert("Yorum en az 10 karakter olmalıdır!");
        return;
      }

      if (!$scope.yeniYorum.puan || $scope.yeniYorum.puan < 1) {
        alert("Lütfen bir puan seçin!");
        return;
      }

      var yorumData = {
        kullanici_id: $scope.kullanici.id,
        kullanici_adi: $scope.kullanici.username,
        tur: "anime",
        icerik_id: animeId,
        icerik_adi: $scope.anime.anime_adi,
        yorum: $scope.yeniYorum.yorum,
        puan: $scope.yeniYorum.puan,
      };

      $http
        .post("api.php?yorum=1", yorumData)
        .then(function (response) {
          if (response.data.success) {
            alert("Yorum başarıyla eklendi!");
            // Formu temizle
            $scope.yeniYorum = {
              yorum: "",
              puan: 0,
            };
            // Yorumları yeniden yükle
            $scope.yorumlariGetir();
          } else {
            alert("Yorum eklenirken hata: " + response.data.message);
          }
        })
        .catch(function (error) {
          alert("Yorum eklenirken hata oluştu: " + error.statusText);
        });
    };

    // Yorum sil
    $scope.yorumSil = function (yorumId) {
      if (confirm("Bu yorumu silmek istediğinizden emin misiniz?")) {
        $http({
          method: "DELETE",
          url:
            "api.php?yorum=1&id=" +
            yorumId +
            "&kullanici_id=" +
            $scope.kullanici.id,
        })
          .then(function (response) {
            if (response.data.success) {
              alert("Yorum başarıyla silindi!");
              $scope.yorumlariGetir();
            } else {
              alert("Yorum silinirken hata: " + response.data.message);
            }
          })
          .catch(function (error) {
            alert("Yorum silinirken hata oluştu: " + error.statusText);
          });
      }
    };

    // Fragman oynatma fonksiyonu
    $scope.fragmanOynat = function () {
      alert(
        "🎬 " +
          $scope.anime.anime_adi +
          " önizleme videosu başlatılıyor...\n\nBu özellik gerçek video oynatıcı ile entegre edilecek."
      );
    };

    // Scroll to top fonksiyonu
    $scope.scrollToTop = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };

    // Sayfa yüklendiğinde animeyi getir
    $scope.animeyiGetir();
  })

  // ===== LIST CONTROLLER =====
  .controller("ListeController", function ($scope, $http) {
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");
    $scope.kisiler = [];
    $scope.currentPage = 1;
    $scope.itemsPerPage = 5;
    $scope.aramaMetni = "";
    $scope.modalAcik = false;
    $scope.duzenlenecekKisi = null;

    console.log("🔍 ListeController başlatıldı");
    console.log("👤 Kullanıcı:", $scope.kullanici);

    // Kullanıcı kontrolü
    if (
      !$scope.kullanici ||
      ($scope.kullanici.rol !== "admin" && $scope.kullanici.rol !== "Yönetici")
    ) {
      console.log("❌ Yetki hatası - Kullanıcı:", $scope.kullanici);
      alert("Bu sayfaya erişim yetkiniz yok!");
      window.location.href = "index.html";
      return;
    }

    console.log("✅ Yetki kontrolü geçildi");

    // Kullanıcıları getir
    $scope.kisileriGetir = function () {
      console.log("🔍 Kullanıcılar getiriliyor...");
      console.log("📡 API çağrısı: api.php?kisiler=1");

      $http
        .get("api.php?kisiler=1")
        .then(function (response) {
          console.log("✅ API yanıtı başarılı");
          console.log("📊 Gelen veri:", response.data);
          console.log("📈 Veri tipi:", typeof response.data);
          console.log(
            "📊 Veri uzunluğu:",
            response.data ? response.data.length : "null"
          );

          if (Array.isArray(response.data)) {
            $scope.kisiler = response.data;
            console.log(
              "✅ Kullanıcılar yüklendi. Toplam:",
              $scope.kisiler.length
            );
            console.log("📋 İlk kullanıcı:", $scope.kisiler[0]);
          } else {
            console.error("❌ Gelen veri array değil:", response.data);
            $scope.kisiler = [];
          }
        })
        .catch(function (error) {
          console.error("❌ API hatası:", error);
          console.error("❌ Hata detayı:", error.status, error.statusText);
          console.error("❌ Hata mesajı:", error.data);
          $scope.kisiler = [];
        });
    };

    // Modal fonksiyonları
    $scope.notuModalIleAc = function (kisi) {
      $scope.duzenlenecekKisi = angular.copy(kisi);
      $scope.modalAcik = true;
    };

    $scope.modalKapat = function () {
      $scope.modalAcik = false;
    };

    $scope.notuGuncelle = function () {
      $http
        .put("api.php", $scope.duzenlenecekKisi)
        .then(function (response) {
          if (response.data.success) {
            showMessage("Not başarıyla güncellendi!", "success");
            $scope.kisileriGetir();
            $scope.modalAcik = false;
          } else {
            showMessage(
              "Güncelleme başarısız: " + (response.data.message || ""),
              "error"
            );
          }
        })
        .catch(function (error) {
          showMessage("Sunucu hatası: " + error.statusText, "error");
        });
    };

    // Kullanıcı sil
    $scope.kisiSil = function (id) {
      if (confirm("Bu kullanıcıyı silmek istediğinizden emin misiniz?")) {
        $http({
          method: "DELETE",
          url: "api.php?id=" + id,
        })
          .then(function (response) {
            if (response.data.success) {
              showMessage("Kullanıcı başarıyla silindi!", "success");
              $scope.kisileriGetir();
            } else {
              showMessage("Silme işlemi başarısız", "error");
            }
          })
          .catch(function (error) {
            showMessage("Silme işlemi sırasında hata oluştu", "error");
          });
      }
    };

    // Kullanıcı güncelle
    $scope.kisiNotuGuncelle = function (kisi) {
      $http
        .put("api.php", kisi)
        .then(function (response) {
          if (response.data.success) {
            showMessage("Kullanıcı bilgileri güncellendi!", "success");
            $scope.kisileriGetir();
          } else {
            showMessage(
              "Güncelleme başarısız: " + (response.data.message || ""),
              "error"
            );
          }
        })
        .catch(function (error) {
          showMessage("Sunucu hatası: " + error.statusText, "error");
        });
    };

    // Sayfalama fonksiyonları
    $scope.pageCount = function () {
      if (!$scope.kisiler) return 0;
      return Math.ceil(($scope.kisiler.length || 0) / $scope.itemsPerPage);
    };

    $scope.paginatedKisiler = function () {
      var start = ($scope.currentPage - 1) * $scope.itemsPerPage;
      return ($scope.kisiler || []).slice(start, start + $scope.itemsPerPage);
    };

    $scope.oncekiSayfa = function () {
      if ($scope.currentPage > 1) {
        $scope.currentPage--;
      }
    };

    $scope.sonrakiSayfa = function () {
      if ($scope.currentPage < $scope.pageCount()) {
        $scope.currentPage++;
      }
    };

    // Yorum yönetimi sayfasına git
    $scope.yorumYonetimiGit = function () {
      window.location.href = "yorum-yonetimi.html";
    };

    // Mesaj yönetimi sayfasına git
    $scope.mesajYonetimiGit = function () {
      window.location.href = "mesaj-yonetimi.html";
    };

    // Sayfa yüklendiğinde kullanıcıları getir
    console.log("🚀 Sayfa yüklendi, kullanıcılar getiriliyor...");
    $scope.kisileriGetir();
  })

  // ===== FILM DETAY CONTROLLER =====
  .controller("FilmDetayController", function ($scope, $http) {
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");
    $scope.loading = true;
    $scope.error = null;
    $scope.film = null;
    $scope.yorumlar = [];
    $scope.yeniYorum = {
      yorum: "",
      puan: 0,
    };

    // URL'den film ID'sini al
    var urlParams = new URLSearchParams(window.location.search);
    var filmId = urlParams.get("id");

    if (!filmId) {
      $scope.error = "Film ID'si bulunamadı!";
      $scope.loading = false;
      return;
    }

    // Film detaylarını yükle
    $scope.filmDetayiniYukle = function () {
      $http
        .get("api.php?films=1&id=" + filmId)
        .then(function (response) {
          if (response.data && !response.data.error) {
            $scope.film = response.data;
            // Sayfa başlığını güncelle
            document.title = $scope.film.film_adi + " - GLOW";
            // Film yüklendikten sonra yorumları getir
            $scope.yorumlariGetir();
          } else {
            $scope.error = response.data.error || "Film bulunamadı!";
          }
          $scope.loading = false;
        })
        .catch(function (error) {
          $scope.error = "Film yüklenirken hata oluştu: " + error.statusText;
          $scope.loading = false;
        });
    };

    // Puan seçimi için yardımcı fonksiyon
    $scope.puanSec = function (puan) {
      console.log("⭐ Puan seçildi:", puan); // Debug log
      $scope.yeniYorum.puan = parseInt(puan);
      // Angular'ın değişiklikleri algılamasını sağla (güvenli)
      if (!$scope.$$phase && !$scope.$root.$$phase) {
        $scope.$apply();
      }
    };

    // Yorumları getir
    $scope.yorumlariGetir = function () {
      console.log("🔍 Yorumlar getiriliyor... Film ID:", filmId);
      console.log(
        "🔍 API URL:",
        "api.php?yorum=1&tur=film&icerik_id=" + filmId
      );

      $http
        .get("api.php?yorum=1&tur=film&icerik_id=" + filmId)
        .then(function (response) {
          console.log("📊 API'den gelen yorumlar:", response.data); // Debug log
          console.log("📊 Yorum sayısı:", response.data.length); // Debug log
          $scope.yorumlar = response.data || []; // Handle null/undefined response
          console.log("📊 Scope'daki yorumlar:", $scope.yorumlar); // Debug log
          // Angular'ın değişiklikleri algılamasını sağla (güvenli)
          if (!$scope.$$phase && !$scope.$root.$$phase) {
            $scope.$apply();
          }
        })
        .catch(function (error) {
          console.error("❌ Yorumlar yüklenirken hata:", error); // Debug log
          $scope.yorumlar = []; // Reset comments on error
          // Angular'ın değişiklikleri algılamasını sağla (güvenli)
          if (!$scope.$$phase && !$scope.$root.$$phase) {
            $scope.$apply();
          }
        });
    };

    // Yorum ekle
    $scope.yorumEkle = function () {
      console.log("🚀 Yorum ekleme başlatıldı"); // Debug log

      if (!$scope.kullanici) {
        alert("Yorum yapmak için giriş yapmalısınız!");
        return;
      }

      if (!$scope.yeniYorum.yorum || $scope.yeniYorum.yorum.length < 10) {
        alert("Yorum en az 10 karakter olmalıdır!");
        return;
      }

      if (!$scope.yeniYorum.puan || $scope.yeniYorum.puan < 1) {
        alert("Lütfen bir puan seçin!");
        return;
      }

      var yorumData = {
        kullanici_id: $scope.kullanici.id,
        kullanici_adi: $scope.kullanici.username,
        tur: "film",
        icerik_id: filmId,
        icerik_adi: $scope.film.film_adi,
        yorum: $scope.yeniYorum.yorum,
        puan: $scope.yeniYorum.puan,
      };

      console.log("📤 Gönderilecek yorum verisi:", yorumData); // Debug log

      $http
        .post("api.php?yorum=1", yorumData)
        .then(function (response) {
          console.log("✅ API yanıtı:", response.data); // Debug log
          if (response.data.success) {
            alert("Yorum başarıyla eklendi!");
            // Formu temizle
            $scope.yeniYorum = {
              yorum: "",
              puan: 0,
            };
            // Angular'ın değişiklikleri algılamasını sağla (güvenli)
            if (!$scope.$$phase && !$scope.$root.$$phase) {
              $scope.$apply();
            }
            // Yorumları yeniden yükle
            $scope.yorumlariGetir();
          } else {
            alert("Yorum eklenirken hata: " + response.data.message);
          }
        })
        .catch(function (error) {
          console.error("❌ Yorum ekleme hatası:", error); // Debug log
          alert("Yorum eklenirken hata oluştu: " + error.statusText);
        });
    };

    // Yorum sil
    $scope.yorumSil = function (yorumId) {
      if (confirm("Bu yorumu silmek istediğinizden emin misiniz?")) {
        $http({
          method: "DELETE",
          url:
            "api.php?yorum=1&id=" +
            yorumId +
            "&kullanici_id=" +
            $scope.kullanici.id,
        })
          .then(function (response) {
            if (response.data.success) {
              alert("Yorum başarıyla silindi!");
              $scope.yorumlariGetir();
            } else {
              alert("Yorum silinirken hata: " + response.data.message);
            }
          })
          .catch(function (error) {
            alert("Yorum silinirken hata oluştu: " + error.statusText);
          });
      }
    };

    // Sayfa yüklendiğinde film detaylarını yükle
    $scope.filmDetayiniYukle();

    // Yukarı çık fonksiyonu
    $scope.scrollToTop = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };
  })

  // Dizi Detay Controller
  .controller("DiziDetayController", function ($scope, $http) {
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");
    $scope.loading = true;
    $scope.error = null;
    $scope.dizi = null;
    $scope.yorumlar = [];
    $scope.yeniYorum = {
      yorum: "",
      puan: 0,
    };

    // URL'den dizi ID'sini al
    var urlParams = new URLSearchParams(window.location.search);
    var diziId = urlParams.get("id");

    if (!diziId) {
      $scope.error = "Dizi ID'si bulunamadı!";
      $scope.loading = false;
      return;
    }

    // Dizi detaylarını yükle
    $scope.diziDetayiniYukle = function () {
      $http
        .get("dizi_api.php?id=" + diziId)
        .then(function (response) {
          if (response.data.success) {
            $scope.dizi = response.data.dizi;
            // Sayfa başlığını güncelle
            document.title = $scope.dizi.dizi_adi + " - GLOW";
            // Dizi yüklendikten sonra yorumları getir
            $scope.yorumlariGetir();
          } else {
            $scope.error = response.data.message || "Dizi bulunamadı!";
          }
          $scope.loading = false;
        })
        .catch(function (error) {
          $scope.error = "Dizi yüklenirken hata oluştu: " + error.statusText;
          $scope.loading = false;
        });
    };

    // Yorumları getir
    $scope.yorumlariGetir = function () {
      $http
        .get("api.php?yorum=1&tur=dizi&icerik_id=" + diziId)
        .then(function (response) {
          $scope.yorumlar = response.data;
        })
        .catch(function (error) {
          console.error("Yorumlar yüklenirken hata:", error);
        });
    };

    // Yorum ekle
    $scope.yorumEkle = function () {
      if (!$scope.kullanici) {
        alert("Yorum yapmak için giriş yapmalısınız!");
        return;
      }

      if (!$scope.yeniYorum.yorum || $scope.yeniYorum.yorum.length < 10) {
        alert("Yorum en az 10 karakter olmalıdır!");
        return;
      }

      if (!$scope.yeniYorum.puan || $scope.yeniYorum.puan < 1) {
        alert("Lütfen bir puan seçin!");
        return;
      }

      var yorumData = {
        kullanici_id: $scope.kullanici.id,
        kullanici_adi: $scope.kullanici.username,
        tur: "dizi",
        icerik_id: diziId,
        icerik_adi: $scope.dizi.dizi_adi,
        yorum: $scope.yeniYorum.yorum,
        puan: $scope.yeniYorum.puan,
      };

      $http
        .post("api.php?yorum=1", yorumData)
        .then(function (response) {
          if (response.data.success) {
            alert("Yorum başarıyla eklendi!");
            // Formu temizle
            $scope.yeniYorum = {
              yorum: "",
              puan: 0,
            };
            // Yorumları yeniden yükle
            $scope.yorumlariGetir();
          } else {
            alert("Yorum eklenirken hata: " + response.data.message);
          }
        })
        .catch(function (error) {
          alert("Yorum eklenirken hata oluştu: " + error.statusText);
        });
    };

    // Yorum sil
    $scope.yorumSil = function (yorumId) {
      if (confirm("Bu yorumu silmek istediğinizden emin misiniz?")) {
        $http({
          method: "DELETE",
          url:
            "api.php?yorum=1&id=" +
            yorumId +
            "&kullanici_id=" +
            $scope.kullanici.id,
        })
          .then(function (response) {
            if (response.data.success) {
              alert("Yorum başarıyla silindi!");
              $scope.yorumlariGetir();
            } else {
              alert("Yorum silinirken hata: " + response.data.message);
            }
          })
          .catch(function (error) {
            alert("Yorum silinirken hata oluştu: " + error.statusText);
          });
      }
    };

    // Sayfa yüklendiğinde dizi detaylarını yükle
    $scope.diziDetayiniYukle();

    // Yukarı çık fonksiyonu
    $scope.scrollToTop = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };
  })

  // ===== YORUM YÖNETİMİ CONTROLLER =====
  .controller("YorumYonetimiController", function ($scope, $http) {
    $scope.yorumlar = [];
    $scope.filteredYorumlar = [];
    $scope.currentPage = 1;
    $scope.itemsPerPage = 10;
    $scope.loading = true;
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");

    // Filtre değişkenleri
    $scope.seciliTur = "";
    $scope.seciliPuan = "";
    $scope.aramaMetni = "";

    // İstatistik değişkenleri
    $scope.toplamYorum = 0;
    $scope.tiyatroYorum = 0;
    $scope.filmYorum = 0;
    $scope.diziYorum = 0;
    $scope.belgeselYorum = 0;
    $scope.animeYorum = 0;

    // Tüm yorumları getir
    $scope.yorumlariGetir = function () {
      $scope.loading = true;
      $http
        .get("api.php?tum_yorumlar=1")
        .then(function (response) {
          $scope.yorumlar = response.data;
          $scope.filteredYorumlar = response.data;
          $scope.istatistikleriHesapla();
          $scope.filtrele();
          $scope.loading = false;
        })
        .catch(function (error) {
          showMessage("Yorumlar yüklenirken hata oluştu", "error");
          $scope.loading = false;
        });
    };

    // İstatistikleri hesapla
    $scope.istatistikleriHesapla = function () {
      $scope.toplamYorum = $scope.yorumlar.length;
      $scope.tiyatroYorum = $scope.yorumlar.filter(
        (y) => y.tur === "tiyatro"
      ).length;
      $scope.filmYorum = $scope.yorumlar.filter((y) => y.tur === "film").length;
      $scope.diziYorum = $scope.yorumlar.filter((y) => y.tur === "dizi").length;
      $scope.belgeselYorum = $scope.yorumlar.filter(
        (y) => y.tur === "belgesel"
      ).length;
      $scope.animeYorum = $scope.yorumlar.filter(
        (y) => y.tur === "anime"
      ).length;
    };

    // Filtreleme fonksiyonu
    $scope.filtrele = function () {
      // Input değerini manuel olarak al
      var searchInput = document.querySelector(".search-box");
      if (searchInput) {
        $scope.aramaMetni = searchInput.value;
      }

      // Puan değerini manuel olarak al
      var puanSelect = document.querySelector('select[ng-model="seciliPuan"]');
      if (puanSelect) {
        $scope.seciliPuan = puanSelect.value;
      }

      // Tür değerini manuel olarak al
      var turSelect = document.querySelector('select[ng-model="seciliTur"]');
      if (turSelect) {
        $scope.seciliTur = turSelect.value;
      }

      var filtered = $scope.yorumlar;

      // Tür filtresi
      if ($scope.seciliTur && $scope.seciliTur !== "") {
        filtered = filtered.filter(function (yorum) {
          return yorum.tur === $scope.seciliTur;
        });
      }

      // Puan filtresi
      if ($scope.seciliPuan && $scope.seciliPuan !== "") {
        var seciliPuanNum = parseInt($scope.seciliPuan);
        filtered = filtered.filter(function (yorum) {
          var yorumPuan = parseInt(yorum.puan) || 0;
          return yorumPuan === seciliPuanNum;
        });
      }

      // Arama filtresi
      if ($scope.aramaMetni && $scope.aramaMetni.trim() !== "") {
        var searchTerm = $scope.aramaMetni.toLowerCase().trim();
        filtered = filtered.filter(function (yorum) {
          return (
            (yorum.kullanici_adi &&
              yorum.kullanici_adi.toLowerCase().includes(searchTerm)) ||
            (yorum.icerik_adi &&
              yorum.icerik_adi.toLowerCase().includes(searchTerm)) ||
            (yorum.yorum && yorum.yorum.toLowerCase().includes(searchTerm))
          );
        });
      }

      $scope.filteredYorumlar = filtered;
      $scope.currentPage = 1; // Filtreleme sonrası ilk sayfaya dön
    };

    // Yorum sil
    $scope.yorumSil = function (yorumId) {
      console.log("🗑️ Yorum silme başladı - ID:", yorumId);

      if (confirm("Bu yorumu silmek istediğinizden emin misiniz?")) {
        // Tam URL kullan
        var baseUrl =
          window.location.origin +
          window.location.pathname.replace(/\/[^\/]*$/, "/");
        var deleteUrl = baseUrl + "api.php?yorum=1&id=" + yorumId;
        var postUrl = baseUrl + "api.php?yorum=1&sil=1&id=" + yorumId;

        console.log("🌐 Base URL:", baseUrl);
        console.log("🔗 Silme URL (DELETE):", deleteUrl);
        console.log("🔗 Silme URL (POST):", postUrl);

        // Önce DELETE method'unu dene
        $http
          .delete(deleteUrl)
          .then(function (response) {
            console.log("📡 API yanıtı (DELETE):", response.data);

            if (response.data.success) {
              console.log("✅ Yorum silme başarılı (DELETE)");
              showMessage("Yorum başarıyla silindi!", "success");
              $scope.yorumlariGetir(); // Yorumları yeniden yükle
            } else {
              console.log(
                "❌ Yorum silme başarısız (DELETE):",
                response.data.message
              );
              showMessage(
                "Yorum silinirken hata: " + (response.data.message || ""),
                "error"
              );
            }
          })
          .catch(function (error) {
            console.log("❌ DELETE method hatası:", error);
            console.log("❌ Hata detayı:", error.status, error.statusText);

            // DELETE başarısız olursa POST method'unu dene
            $http
              .post(postUrl)
              .then(function (response) {
                console.log("📡 API yanıtı (POST):", response.data);

                if (response.data.success) {
                  console.log("✅ Yorum silme başarılı (POST)");
                  showMessage("Yorum başarıyla silindi!", "success");
                  $scope.yorumlariGetir(); // Yorumları yeniden yükle
                } else {
                  console.log(
                    "❌ Yorum silme başarısız (POST):",
                    response.data.message
                  );
                  showMessage(
                    "Yorum silinirken hata: " + (response.data.message || ""),
                    "error"
                  );
                }
              })
              .catch(function (postError) {
                console.log("❌ POST method da başarısız:", postError);
                console.log(
                  "❌ POST hata detayı:",
                  postError.status,
                  postError.statusText
                );
                showMessage(
                  "Yorum silinirken hata oluştu: " + postError.statusText,
                  "error"
                );
              });
          });
      } else {
        console.log("❌ Yorum silme iptal edildi");
      }
    };

    // Yorumları yenile
    $scope.yorumlariYenile = function () {
      $scope.yorumlariGetir();
    };

    // Liste sayfasına git
    $scope.listeSayfasinaGit = function () {
      window.location.href = "liste.html";
    };

    // Sayfalama fonksiyonları
    $scope.pageCount = function () {
      return Math.ceil($scope.filteredYorumlar.length / $scope.itemsPerPage);
    };

    $scope.paginatedYorumlar = function () {
      var start = ($scope.currentPage - 1) * $scope.itemsPerPage;
      return $scope.filteredYorumlar.slice(start, start + $scope.itemsPerPage);
    };

    $scope.oncekiSayfa = function () {
      if ($scope.currentPage > 1) {
        $scope.currentPage--;
      }
    };

    $scope.sonrakiSayfa = function () {
      if ($scope.currentPage < $scope.pageCount()) {
        $scope.currentPage++;
      }
    };

    // Yukarı çık fonksiyonu
    $scope.scrollToTop = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };

    // Sayfa yüklendiğinde yorumları getir
    $scope.yorumlariGetir();

    // İçerik sayfasına git
    $scope.icerikSayfasinaGit = function (icerikAdi, tur, icerikId) {
      console.log("🔗 İçerik sayfasına gitme:", icerikAdi, tur, icerikId);

      // İçerik ID'si varsa doğrudan detay sayfasına git
      if (icerikId) {
        switch (tur.toLowerCase()) {
          case "film":
            window.location.href = "film-detay.html?id=" + icerikId;
            break;
          case "dizi":
            window.location.href = "dizi-detay.html?id=" + icerikId;
            break;
          case "tiyatro":
            window.location.href = "tiyatro-detay.html?id=" + icerikId;
            break;
          case "belgesel":
            window.location.href = "belgesel-detay.html?id=" + icerikId;
            break;
          case "anime":
            window.location.href = "anime-detay.html?id=" + icerikId;
            break;
          default:
            window.location.href = "anasayfa.html";
            break;
        }
      } else {
        // İçerik ID yoksa ana kategori sayfasına git
        switch (tur.toLowerCase()) {
          case "film":
            window.location.href = "film-kategoriler.html";
            break;
          case "dizi":
            window.location.href = "dizi-kategoriler.html";
            break;
          case "tiyatro":
            window.location.href = "tiyatro.html";
            break;
          case "belgesel":
            window.location.href = "belgesel.html";
            break;
          case "anime":
            window.location.href = "anime.html";
            break;
          default:
            window.location.href = "anasayfa.html";
            break;
        }
      }
    };
  });

// ===== MESAJ YÖNETİMİ CONTROLLER =====
angular
  .module("GirisApp")
  .controller("MesajYonetimiController", function ($scope, $http) {
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");
    $scope.mesajlar = [];
    $scope.currentPage = 1;
    $scope.itemsPerPage = 10;
    $scope.aramaMetni = "";

    // Kullanıcı kontrolü
    if (
      !$scope.kullanici ||
      ($scope.kullanici.rol !== "admin" && $scope.kullanici.rol !== "Yönetici")
    ) {
      alert("Bu sayfaya erişim yetkiniz yok!");
      window.location.href = "index.html";
      return;
    }

    // Mesajları getir
    $scope.mesajlariGetir = function () {
      console.log("🔍 Mesajlar getiriliyor...");
      $http
        .get("api.php?mesajlar=1")
        .then(function (response) {
          console.log("📊 API yanıtı:", response.data);
          if (response.data && !response.data.error) {
            $scope.mesajlar = response.data;
            console.log(
              "✅ Mesajlar yüklendi. Toplam:",
              $scope.mesajlar.length
            );
            console.log("📋 Mesaj listesi:", $scope.mesajlar);
          } else {
            $scope.mesajlar = [];
            console.error("❌ Mesajlar yüklenirken hata:", response.data.error);
          }
        })
        .catch(function (error) {
          console.error("❌ Mesajlar yüklenirken hata:", error);
          $scope.mesajlar = [];
        });
    };

    // Sayfalama fonksiyonları
    $scope.paginatedMesajlar = function () {
      var start = ($scope.currentPage - 1) * $scope.itemsPerPage;
      var end = start + $scope.itemsPerPage;
      return $scope.mesajlar.slice(start, end);
    };

    $scope.pageCount = function () {
      return Math.ceil($scope.mesajlar.length / $scope.itemsPerPage);
    };

    $scope.oncekiSayfa = function () {
      if ($scope.currentPage > 1) {
        $scope.currentPage--;
      }
    };

    $scope.sonrakiSayfa = function () {
      if ($scope.currentPage < $scope.pageCount()) {
        $scope.currentPage++;
      }
    };

    // Mesaj sil
    $scope.mesajSil = function (mesajId) {
      if (confirm("Bu mesajı silmek istediğinizden emin misiniz?")) {
        $http
          .delete("api.php?id=" + mesajId + "&mesaj=1")
          .then(function (response) {
            if (response.data && response.data.success) {
              showMessage("Mesaj başarıyla silindi!", "success");
              $scope.mesajlariGetir();
            } else {
              showMessage("Mesaj silinirken hata oluştu!", "error");
            }
          })
          .catch(function (error) {
            console.error("Mesaj silme hatası:", error);
            showMessage("Mesaj silinirken hata oluştu!", "error");
          });
      }
    };

    // Liste sayfasına git
    $scope.listeSayfasinaGit = function () {
      window.location.href = "liste.html";
    };

    // Sayfa yüklendiğinde mesajları getir
    $scope.mesajlariGetir();
  });

// ===== UTILITY FUNCTIONS =====
function showMessage(message, type = "info") {
  const alertDiv = document.createElement("div");
  alertDiv.className = `alert alert-${type}`;
  alertDiv.textContent = message;
  alertDiv.style.cssText = `
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 15px 20px;
    border-radius: 8px;
    color: white;
    font-weight: 600;
    z-index: 10000;
    animation: slideIn 0.3s ease;
  `;

  if (type === "success") {
    alertDiv.style.background = "linear-gradient(135deg, #4CAF50, #45a049)";
  } else if (type === "error") {
    alertDiv.style.background = "linear-gradient(135deg, #f44336, #da190b)";
  } else {
    alertDiv.style.background = "linear-gradient(135deg, #2196F3, #0b7dda)";
  }

  document.body.appendChild(alertDiv);

  setTimeout(() => {
    alertDiv.style.animation = "slideOut 0.3s ease";
    setTimeout(() => {
      document.body.removeChild(alertDiv);
    }, 300);
  }, 3000);
}

// CSS Animations
const style = document.createElement("style");
style.textContent = `
  @keyframes slideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
  }
  
  @keyframes slideOut {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(100%); opacity: 0; }
  }
`;
document.head.appendChild(style);

// ===== FILTERS =====
angular.module("GirisApp").filter("trustUrl", function ($sce) {
  return function (url) {
    return $sce.trustAsResourceUrl(url);
  };
});

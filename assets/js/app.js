// ===== GLOBAL FADE FUNCTIONS =====
// Tüm sayfalarda kullanılabilir header fade fonksiyonları
window.headerFade = function () {
  console.log("Global headerFade çağrıldı!");

  // Sadece belirli elementleri saydamlaştır, kategorileri değil
  var elementsToFade = document.querySelectorAll(
    ".main-content, footer, #scrollTopBtn, .kitap-container"
  );

  elementsToFade.forEach(function (element) {
    if (element) {
      element.style.opacity = "0.3";
      element.style.transition = "opacity 0.3s ease";
    }
  });

  // Header'ı da saydamlaştır ama kategorileri koru
  var header = document.querySelector(".site-header");
  if (header) {
    header.style.opacity = "0.3";
    header.style.transition = "opacity 0.3s ease";
  }

  // Kategoriler menüsünü kesinlikle opak tut
  var categoryElements = document.querySelectorAll(
    ".category-menu, .category-text, .dropdown-menu, .dropdown-item, .submenu, .submenu-item, .dropdown-item-with-submenu"
  );
  categoryElements.forEach(function (element) {
    if (element) {
      element.style.opacity = "1";
      element.style.zIndex = "999999";
      element.style.pointerEvents = "auto";
    }
  });
};

window.headerNormal = function () {
  console.log("Global headerNormal çağrıldı!");

  // Tüm elementleri normale döndür
  var elementsToFade = document.querySelectorAll(
    ".main-content, footer, #scrollTopBtn, .kitap-container"
  );

  elementsToFade.forEach(function (element) {
    if (element) {
      element.style.opacity = "1";
      element.style.transition = "opacity 0.3s ease";
    }
  });

  // Header'ı da normale döndür
  var header = document.querySelector(".site-header");
  if (header) {
    header.style.opacity = "1";
    header.style.transition = "opacity 0.3s ease";
  }

  // Kategoriler menüsünü normale döndür
  var categoryElements = document.querySelectorAll(
    ".category-menu, .category-text, .dropdown-menu, .dropdown-item, .submenu, .submenu-item, .dropdown-item-with-submenu"
  );
  categoryElements.forEach(function (element) {
    if (element) {
      element.style.opacity = "1";
      element.style.zIndex = "auto";
      element.style.pointerEvents = "auto";
    }
  });
};

// ===== KATEGORİLER İÇİN ÖZEL FONKSİYONLAR =====
window.categoryHover = function () {
  console.log("Kategori hover başladı!");

  // Sadece sayfa içeriğini saydamlaştır, header'ı değil
  var elementsToFade = document.querySelectorAll(
    ".main-content, footer, #scrollTopBtn, .kitap-container"
  );

  elementsToFade.forEach(function (element) {
    if (element) {
      element.style.opacity = "0.3";
      element.style.transition = "opacity 0.2s ease";
    }
  });

  // Kategoriler menüsünü kesinlikle opak tut
  var categoryElements = document.querySelectorAll(
    ".category-menu, .category-text, .dropdown-menu, .dropdown-item, .submenu, .submenu-item, .dropdown-item-with-submenu"
  );
  categoryElements.forEach(function (element) {
    if (element) {
      element.style.opacity = "1";
      element.style.zIndex = "999999";
      element.style.pointerEvents = "auto";
    }
  });
};

window.categoryLeave = function () {
  console.log("Kategori hover bitti!");

  // Tüm elementleri normale döndür
  var elementsToFade = document.querySelectorAll(
    ".main-content, footer, #scrollTopBtn, .kitap-container"
  );

  elementsToFade.forEach(function (element) {
    if (element) {
      element.style.opacity = "1";
      element.style.transition = "opacity 0.2s ease";
    }
  });

  // Kategoriler menüsünü normale döndür
  var categoryElements = document.querySelectorAll(
    ".category-menu, .category-text, .dropdown-menu, .dropdown-item, .submenu, .submenu-item, .dropdown-item-with-submenu"
  );
  categoryElements.forEach(function (element) {
    if (element) {
      element.style.opacity = "1";
      element.style.zIndex = "auto";
      element.style.pointerEvents = "auto";
    }
  });
};

// ===== USER DROPDOWN MENU FUNCTIONS =====
window.userMenuHover = function () {
  console.log("User menu hover başladı!");

  // User dropdown menüsünü kesinlikle opak tut
  var userElements = document.querySelectorAll(
    ".user-menu, .user-link, .user-dropdown-menu, .dropdown-arrow, .dropdown-item-with-submenu, .submenu"
  );
  userElements.forEach(function (element) {
    if (element) {
      element.style.opacity = "1";
      element.style.zIndex = "99999";
      element.style.pointerEvents = "auto";
      element.style.overflow = "visible";
    }
  });

  // Submenu'yu özellikle görünür yap
  var submenus = document.querySelectorAll(".user-dropdown-menu .submenu");
  submenus.forEach(function (submenu) {
    if (submenu) {
      submenu.style.zIndex = "99999";
      submenu.style.overflow = "visible";
    }
  });
};

window.userMenuLeave = function () {
  console.log("User menu hover bitti!");

  // User dropdown menüsünü normale döndür
  var userElements = document.querySelectorAll(
    ".user-menu, .user-link, .user-dropdown-menu, .dropdown-arrow, .dropdown-item-with-submenu, .submenu"
  );
  userElements.forEach(function (element) {
    if (element) {
      element.style.opacity = "1";
      element.style.zIndex = "auto";
      element.style.pointerEvents = "auto";
    }
  });
};

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
  .filter("saniyeToDakika", function () {
    return function (saniye) {
      if (!saniye) return "N/A";

      // Eğer zaten dakika:saniye formatındaysa (örn: "3:45")
      if (typeof saniye === "string" && saniye.includes(":")) {
        return saniye;
      }

      // Eğer sayıysa saniye olarak kabul et
      if (!isNaN(saniye)) {
        var dakika = Math.floor(saniye / 60);
        var kalanSaniye = saniye % 60;
        return dakika + ":" + (kalanSaniye < 10 ? "0" : "") + kalanSaniye;
      }

      return "N/A";
    };
  })
  .filter("trustUrl", function ($sce) {
    return function (url) {
      return $sce.trustAsResourceUrl(url);
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

    // Header fade efekti
    $scope.headerFade = function () {
      // Header elementleri
      var authSection = document.querySelector(".auth-section");
      var logoSection = document.querySelector(".logo-section");
      var navLinks = document.querySelectorAll(
        ".nav-menu > li:not(.category-menu) > a"
      );

      // Tüm sayfa içeriği
      var mainContent = document.querySelector(".main-content");
      var footer = document.querySelector("footer");
      var scrollTopBtn = document.querySelector("#scrollTopBtn");

      // Header elementlerini saydamlaştır
      if (authSection) authSection.classList.add("header-fade");
      if (logoSection) logoSection.classList.add("header-fade");
      navLinks.forEach(function (link) {
        link.classList.add("header-fade");
      });

      // Sayfa içeriğini saydamlaştır
      if (mainContent) mainContent.classList.add("page-fade");
      if (footer) footer.classList.add("page-fade");
      if (scrollTopBtn) scrollTopBtn.classList.add("page-fade");
    };

    $scope.headerNormal = function () {
      // Header elementleri
      var authSection = document.querySelector(".auth-section");
      var logoSection = document.querySelector(".logo-section");
      var navLinks = document.querySelectorAll(
        ".nav-menu > li:not(.category-menu) > a"
      );

      // Tüm sayfa içeriği
      var mainContent = document.querySelector(".main-content");
      var footer = document.querySelector("footer");
      var scrollTopBtn = document.querySelector("#scrollTopBtn");

      // Header elementlerini normale döndür
      if (authSection) authSection.classList.remove("header-fade");
      if (logoSection) logoSection.classList.remove("header-fade");
      navLinks.forEach(function (link) {
        link.classList.remove("header-fade");
      });

      // Sayfa içeriğini normale döndür
      if (mainContent) mainContent.classList.remove("page-fade");
      if (footer) footer.classList.remove("page-fade");
      if (scrollTopBtn) scrollTopBtn.classList.remove("page-fade");
    };
  })

  // ===== LOGIN CONTROLLER =====
  .controller(
    "GirisController",
    function ($scope, $http, $timeout, $rootScope) {
      $scope.formData = {
        username: "",
        password: "",
      };
      $scope.girisKontrol = function () {
        var girisYapan = localStorage.getItem("girisYapan");
        if (girisYapan != null) {
          window.location.href = "anasayfa.html";
        }
        console.log(girisYapan);
      };
      $scope.girisKontrol();

      $scope.girisYap = function () {
        // Önceki hata mesajını temizle
        $scope.errorMessage = null;
        $rootScope.errorMessage = null;

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
              $timeout(function () {
                $scope.errorMessage = "Hatalı kullanıcı adı ya da şifre";
                $rootScope.errorMessage = "Hatalı kullanıcı adı ya da şifre";
                // 5 saniye sonra hata mesajını kaldır
                $timeout(function () {
                  $scope.errorMessage = null;
                  $rootScope.errorMessage = null;
                }, 5000);
              });
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

            // Detaylı hata mesajları
            $timeout(function () {
              if (error.status === 0) {
                $scope.errorMessage =
                  "Sunucuya bağlanılamıyor. XAMPP/WAMP çalışıyor mu?";
                $rootScope.errorMessage =
                  "Sunucuya bağlanılamıyor. XAMPP/WAMP çalışıyor mu?";
              } else if (error.status === 404) {
                $scope.errorMessage =
                  "API dosyası bulunamadı. api.php dosyası mevcut mu?";
                $rootScope.errorMessage =
                  "API dosyası bulunamadı. api.php dosyası mevcut mu?";
              } else if (error.status === 500) {
                $scope.errorMessage =
                  "Sunucu hatası. Veritabanı bağlantısını kontrol edin.";
                $rootScope.errorMessage =
                  "Sunucu hatası. Veritabanı bağlantısını kontrol edin.";
              } else if (error.data && error.data.message) {
                $scope.errorMessage = "Bir hata oluştu: " + error.data.message;
                $rootScope.errorMessage =
                  "Bir hata oluştu: " + error.data.message;
              } else {
                $scope.errorMessage =
                  "Sunucu bağlantı hatası! Lütfen tekrar deneyin.";
                $rootScope.errorMessage =
                  "Sunucu bağlantı hatası! Lütfen tekrar deneyin.";
              }

              // 5 saniye sonra hata mesajını kaldır
              $timeout(function () {
                $scope.errorMessage = null;
                $rootScope.errorMessage = null;
              }, 5000);
            });
          });
      };
    }
  )

  // ===== REGISTER CONTROLLER =====
  .controller("KayitController", function ($scope, $http) {
    // Form validasyon durumu
    $scope.formErrors = {
      username: false,
      adsoyad: false,
      sifre: false,
      eposta: false
    };

    // Form gönderilme durumu
    $scope.formSubmitted = false;

    // E-posta validasyon fonksiyonu
    $scope.validateEmail = function (email) {
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    };

    $scope.kayitOl = function () {
      // Form gönderildi olarak işaretle
      $scope.formSubmitted = true;

      // Form validasyon durumlarını sıfırla
      $scope.formErrors = {
        username: false,
        adsoyad: false,
        sifre: false,
        eposta: false
      };

      var hasError = false;

      // Kullanıcı adı kontrolü
      if (!$scope.username || $scope.username.trim() === "") {
        $scope.formErrors.username = true;
        hasError = true;
      }

      // Ad soyad kontrolü
      if (!$scope.adsoyad || $scope.adsoyad.trim() === "") {
        $scope.formErrors.adsoyad = true;
        hasError = true;
      }

      // Şifre kontrolü
      if (!$scope.sifre || $scope.sifre.length < 6 || $scope.sifre.length > 10) {
        $scope.formErrors.sifre = true;
        hasError = true;
      }

      // E-posta kontrolü
      if (!$scope.eposta || $scope.eposta.trim() === "") {
        $scope.formErrors.eposta = true;
        hasError = true;
      } else if (!$scope.validateEmail($scope.eposta)) {
        $scope.formErrors.eposta = true;
        hasError = true;
      }

      if (hasError) {
        showMessage("Lütfen tüm alanları doğru şekilde doldurunuz!", "error");
        return;
      }

      // Loading durumu
      $scope.loading = true;

      $http
        .post("api.php?kayit=1", {
          username: $scope.username.trim(),
          adsoyad: $scope.adsoyad.trim(),
          sifre: $scope.sifre,
          eposta: $scope.eposta.trim(),
          rol: "kullanici",
        })
        .then(function (response) {
          $scope.loading = false;
          if (response.data.success) {
            showMessage("🎉 Kayıt başarılı! Giriş yapabilirsiniz.", "success");
            setTimeout(function () {
              window.location.href = "index.html";
            }, 2000);
          } else {
            showMessage(
              "❌ Kayıt işlemi başarısız: " + response.data.message,
              "error"
            );
          }
        })
        .catch(function (error) {
          $scope.loading = false;
          console.error("Kayıt hatası:", error);
          if (error.data && error.data.message) {
            showMessage("❌ " + error.data.message, "error");
          } else {
            showMessage(
              "❌ Sunucu bağlantı hatası! Lütfen tekrar deneyin.",
              "error"
            );
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
      window.location.href = "/kitaplar";
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

    $scope.bilgilerimSayfasi = function () {
      window.location.href = "bilgilerim.html";
    };
  })

  // ===== BILGILERIM CONTROLLER =====
  .controller("BilgilerimController", function ($scope, $http, $timeout) {
    // Kullanıcı kontrolü
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");

    if (!$scope.kullanici || !$scope.kullanici.id) {
      alert("Giriş yapılmamış. Lütfen tekrar giriş yapın.");
      window.location.href = "index.html";
      return;
    }

    // E-posta alanını ekle (eğer yoksa)
    if (!$scope.kullanici.email) {
      $scope.kullanici.email = $scope.kullanici.e_posta || "";
    }

    $scope.yeniSifre = "";
    $scope.kaydetiliyor = false;
    $scope.message = "";
    $scope.messageClass = "";

    // Şifre gücü kontrolü
    $scope.$watch("yeniSifre", function (newVal) {
      if (newVal) {
        $scope.sifreGucu = sifreGucuHesapla(newVal);
      }
    });

    function sifreGucuHesapla(sifre) {
      if (sifre.length < 6) return "strength-weak";
      if (sifre.length < 8) return "strength-medium";
      if (sifre.length < 10) return "strength-strong";
      return "strength-very-strong";
    }

    $scope.bilgileriKaydet = function () {
      // Form validasyonu
      if (
        !$scope.kullanici.username ||
        !$scope.kullanici.adsoyad ||
        !$scope.kullanici.email
      ) {
        $scope.message = "❌ Lütfen tüm zorunlu alanları doldurun!";
        $scope.messageClass = "message-error";
        return;
      }

      // E-posta formatı kontrolü
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test($scope.kullanici.email)) {
        $scope.message = "❌ Lütfen geçerli bir e-posta adresi girin!";
        $scope.messageClass = "message-error";
        return;
      }

      // Şifre kontrolü
      if (
        $scope.yeniSifre &&
        ($scope.yeniSifre.length < 6 || $scope.yeniSifre.length > 10)
      ) {
        $scope.message = "❌ Şifre 6-10 karakter arasında olmalıdır!";
        $scope.messageClass = "message-error";
        return;
      }

      $scope.kaydetiliyor = true;
      $scope.message = "";

      var gonderilecek = angular.copy($scope.kullanici);

      // E-posta alanını doğru şekilde gönder
      gonderilecek.e_posta = $scope.kullanici.email;

      // Şifre güncelleme
      if ($scope.yeniSifre) {
        gonderilecek.sifre = $scope.yeniSifre;
      }

      $http
        .put("api.php", gonderilecek)
        .then(function (response) {
          if (response.data.success) {
            // LocalStorage'ı güncelle - email alanını da ekle
            $scope.kullanici.e_posta = $scope.kullanici.email;
            localStorage.setItem(
              "girisYapan",
              JSON.stringify($scope.kullanici)
            );

            $scope.message = "✅ Bilgileriniz başarıyla güncellendi!";
            $scope.messageClass = "message-success";

            // Şifre alanını temizle
            $scope.yeniSifre = "";

            // 3 saniye sonra mesajı kaldır
            $timeout(function () {
              $scope.message = "";
            }, 3000);
          } else {
            $scope.message =
              "❌ Güncelleme başarısız: " +
              (response.data.message || "Bilinmeyen hata");
            $scope.messageClass = "message-error";
          }
        })
        .catch(function (error) {
          console.error("Bilgilerim güncelleme hatası:", error);
          $scope.message = "❌ Sunucu hatası! Lütfen tekrar deneyin.";
          $scope.messageClass = "message-error";
        })
        .finally(function () {
          $scope.kaydetiliyor = false;
        });
    };

    $scope.profilSayfasinaDon = function () {
      window.location.href = "profil.html";
    };

    $scope.scrollToTop = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
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
  .controller(
    "TiyatroDetayController",
    function ($scope, $http, $location, $timeout) {
      $scope.kullanici = JSON.parse(
        localStorage.getItem("girisYapan") || "null"
      );
      $scope.tiyatroEseri = null;
      $scope.loading = true;
      $scope.error = null;
      $scope.yorumlar = [];
      $scope.yeniYorum = {
        yorum: "",
        puan: 0,
        spoiler: false,
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

            // Yorum verilerini temizle (gereksiz boşlukları kaldır)
            var temizlenmisYorumlar = (response.data || []).map(function (
              yorum
            ) {
              return {
                ...yorum,
                yorum: yorum.yorum
                  ? yorum.yorum.trim().replace(/\s+/g, " ")
                  : yorum.yorum,
              };
            });

            $scope.yorumlar = temizlenmisYorumlar;
            console.log("📊 Scope'daki yorumlar:", $scope.yorumlar);
            console.log(
              "📊 Yorumlar array mi?",
              Array.isArray($scope.yorumlar)
            );
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
                  return (
                    key + ": " + yorum[key] + " (" + typeof yorum[key] + ")"
                  );
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
              console.log(
                "  - puan:",
                yorum.puan,
                "(" + typeof yorum.puan + ")"
              );
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

        // Karakter uyarısını gizle (başlangıçta)
        var karakterUyari = document.querySelector("#global-karakter-uyari");
        if (karakterUyari) {
          karakterUyari.classList.remove("show");
        }

        if (!$scope.yeniYorum.yorum || $scope.yeniYorum.yorum.length < 10) {
          // Karakter uyarısını göster ve titreme animasyonu ekle
          console.log("🔍 Tiyatro: Karakter uyarısı gösteriliyor...");

          $timeout(function () {
            var karakterUyari = document.querySelector(
              "#global-karakter-uyari"
            );
            if (karakterUyari) {
              console.log(
                "✅ Tiyatro: Element bulundu, show ve shake sınıfı ekleniyor..."
              );
              karakterUyari.classList.add("show", "shake");

              // 3 saniye sonra uyarıyı gizle
              $timeout(function () {
                console.log("🔄 Tiyatro: Karakter uyarısı gizleniyor...");
                karakterUyari.classList.remove("show");
              }, 3000);

              // Shake animasyonunu kaldır
              $timeout(function () {
                karakterUyari.classList.remove("shake");
              }, 500);
            }
          }, 100);
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
          yorum: $scope.yeniYorum.yorum
            ? $scope.yeniYorum.yorum.trim()
            : $scope.yeniYorum.yorum,
          puan: $scope.yeniYorum.puan,
          spoiler: $scope.yeniYorum.spoiler ? 1 : 0,
        };

        console.log("📤 Gönderilecek veri:", yorumData);

        $http
          .post("api.php?yorum=1", yorumData)
          .then(function (response) {
            console.log("📥 API yanıtı:", response);
            if (response.data.success) {
              showMessage("Yorum başarıyla eklendi!", "success");
              // Formu temizle
              $scope.yeniYorum = {
                yorum: "",
                puan: 0,
                spoiler: false,
              };
              // Yorumları yeniden yükle
              $scope.yorumlariGetir();
              // Sayfayı yenile (güvenlik için)
              setTimeout(function () {
                location.reload();
              }, 1000);
            } else {
              showMessage(
                "Yorum eklenirken hata: " + response.data.message,
                "error"
              );
            }
          })
          .catch(function (error) {
            console.error("❌ Yorum ekleme hatası:", error);
            console.error("❌ Hata detayı:", error.data);
            showMessage(
              "Yorum eklenirken hata oluştu: " + error.statusText,
              "error"
            );
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
    }
  )

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
  .controller(
    "BelgeselDetayController",
    function ($scope, $http, $location, $timeout) {
      $scope.kullanici = JSON.parse(
        localStorage.getItem("girisYapan") || "null"
      );
      $scope.belgesel = null;
      $scope.loading = true;
      $scope.error = null;
      $scope.yorumlar = [];
      $scope.yeniYorum = {
        yorum: "",
        puan: 0,
        spoiler: false,
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
            // Yorum verilerini temizle (gereksiz boşlukları kaldır)
            var temizlenmisYorumlar = (response.data || []).map(function (
              yorum
            ) {
              return {
                ...yorum,
                yorum: yorum.yorum
                  ? yorum.yorum.trim().replace(/\s+/g, " ")
                  : yorum.yorum,
              };
            });

            $scope.yorumlar = temizlenmisYorumlar;
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

        // Karakter uyarısını gizle (başlangıçta)
        var karakterUyari = document.querySelector("#global-karakter-uyari");
        if (karakterUyari) {
          karakterUyari.classList.remove("show");
        }

        if (!$scope.yeniYorum.yorum || $scope.yeniYorum.yorum.length < 10) {
          // Karakter uyarısını göster ve titreme animasyonu ekle
          console.log("🔍 Belgesel: Karakter uyarısı gösteriliyor...");

          $timeout(function () {
            var karakterUyari = document.querySelector(
              "#global-karakter-uyari"
            );
            if (karakterUyari) {
              console.log(
                "✅ Belgesel: Element bulundu, show ve shake sınıfı ekleniyor..."
              );
              karakterUyari.classList.add("show", "shake");

              // 3 saniye sonra uyarıyı gizle
              $timeout(function () {
                console.log("🔄 Belgesel: Karakter uyarısı gizleniyor...");
                karakterUyari.classList.remove("show");
              }, 3000);

              // Shake animasyonunu kaldır
              $timeout(function () {
                karakterUyari.classList.remove("shake");
              }, 500);
            }
          }, 100);
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
          yorum: $scope.yeniYorum.yorum
            ? $scope.yeniYorum.yorum.trim()
            : $scope.yeniYorum.yorum,
          puan: $scope.yeniYorum.puan,
          spoiler: $scope.yeniYorum.spoiler ? 1 : 0,
        };

        $http
          .post("api.php?yorum=1", yorumData)
          .then(function (response) {
            if (response.data.success) {
              showMessage("Yorum başarıyla eklendi!", "success");
              // Formu temizle
              $scope.yeniYorum = {
                yorum: "",
                puan: 0,
                spoiler: false,
              };
              // Yorumları yeniden yükle
              $scope.yorumlariGetir();
            } else {
              showMessage(
                "Yorum eklenirken hata: " + response.data.message,
                "error"
              );
            }
          })
          .catch(function (error) {
            showMessage(
              "Yorum eklenirken hata oluştu: " + error.statusText,
              "error"
            );
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
    }
  )

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
  .controller(
    "AnimeDetayController",
    function ($scope, $http, $location, $timeout) {
      $scope.kullanici = JSON.parse(
        localStorage.getItem("girisYapan") || "null"
      );
      $scope.anime = null;
      $scope.loading = true;
      $scope.error = null;
      $scope.yorumlar = [];
      $scope.yeniYorum = {
        yorum: "",
        puan: 0,
        spoiler: false,
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
            // Yorum verilerini temizle (gereksiz boşlukları kaldır)
            var temizlenmisYorumlar = (response.data || []).map(function (
              yorum
            ) {
              return {
                ...yorum,
                yorum: yorum.yorum
                  ? yorum.yorum.trim().replace(/\s+/g, " ")
                  : yorum.yorum,
              };
            });

            $scope.yorumlar = temizlenmisYorumlar;
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

        // Karakter uyarısını gizle (başlangıçta)
        var karakterUyari = document.querySelector("#global-karakter-uyari");
        if (karakterUyari) {
          karakterUyari.classList.remove("show");
        }

        if (!$scope.yeniYorum.yorum || $scope.yeniYorum.yorum.length < 10) {
          // Karakter uyarısını göster ve titreme animasyonu ekle
          console.log("🔍 Anime: Karakter uyarısı gösteriliyor...");

          $timeout(function () {
            var karakterUyari = document.querySelector(
              "#global-karakter-uyari"
            );
            if (karakterUyari) {
              console.log(
                "✅ Anime: Element bulundu, show ve shake sınıfı ekleniyor..."
              );
              karakterUyari.classList.add("show", "shake");

              // 3 saniye sonra uyarıyı gizle
              $timeout(function () {
                console.log("🔄 Anime: Karakter uyarısı gizleniyor...");
                karakterUyari.classList.remove("show");
              }, 3000);

              // Shake animasyonunu kaldır
              $timeout(function () {
                karakterUyari.classList.remove("shake");
              }, 500);
            }
          }, 100);
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
          yorum: $scope.yeniYorum.yorum
            ? $scope.yeniYorum.yorum.trim()
            : $scope.yeniYorum.yorum,
          puan: $scope.yeniYorum.puan,
          spoiler: $scope.yeniYorum.spoiler ? 1 : 0,
        };

        $http
          .post("api.php?yorum=1", yorumData)
          .then(function (response) {
            if (response.data.success) {
              showMessage("Yorum başarıyla eklendi!", "success");
              // Formu temizle
              $scope.yeniYorum = {
                yorum: "",
                puan: 0,
                spoiler: false,
              };
              // Yorumları yeniden yükle
              $scope.yorumlariGetir();
            } else {
              showMessage(
                "Yorum eklenirken hata: " + response.data.message,
                "error"
              );
            }
          })
          .catch(function (error) {
            showMessage(
              "Yorum eklenirken hata oluştu: " + error.statusText,
              "error"
            );
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
        if ($scope.anime.onizleme) {
          // Önizleme varsa yeni sekmede aç
          window.open($scope.anime.onizleme, "_blank");
        } else {
          alert(
            "🎬 " +
              $scope.anime.anime_adi +
              " için henüz önizleme videosu bulunmuyor.\n\nBu anime'nin önizleme videosu yakında eklenecek."
          );
        }
      };

      // Scroll to top fonksiyonu
      $scope.scrollToTop = function () {
        window.scrollTo({ top: 0, behavior: "smooth" });
      };

      // Sayfa yüklendiğinde animeyi getir
      $scope.animeyiGetir();
    }
  )

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
            // Adminleri en başa taşı
            var adminler = response.data.filter(function(k) { return k.rol === 'admin'; });
            var kullanicilar = response.data.filter(function(k) { return k.rol !== 'admin'; });
            
            // Adminleri önce, sonra kullanıcıları ekle
            $scope.kisiler = adminler.concat(kullanicilar);
            
            console.log(
              "✅ Kullanıcılar yüklendi. Toplam:",
              $scope.kisiler.length
            );
            console.log("👑 Admin sayısı:", adminler.length);
            console.log("👤 Kullanıcı sayısı:", kullanicilar.length);
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

    // Silme onayını göster/gizle
    $scope.silmeOnayiGoster = function (id) {
      // Seçilen kullanıcıyı bul
      var kisi = $scope.kisiler.find(function (k) {
        return k.id == id;
      });

      if (kisi) {
        // Eğer bu kullanıcının onayı zaten açıksa, kapat
        if (kisi.silmeOnayiGoster) {
          kisi.silmeOnayiGoster = false;
        } else {
          // Önce tüm açık onayları kapat
          $scope.kisiler.forEach(function (k) {
            k.silmeOnayiGoster = false;
          });
          // Bu kullanıcının onayını aç
          kisi.silmeOnayiGoster = true;
        }
      }
    };

    // Silme onayını kapat
    $scope.silmeOnayiKapat = function (kisi) {
      kisi.silmeOnayiGoster = false;
    };

    // Kullanıcı sil
    $scope.kisiSil = function (id) {
      // Önce onay alanını kapat
      var kisi = $scope.kisiler.find(function (k) {
        return k.id == id;
      });
      if (kisi) {
        kisi.silmeOnayiGoster = false;
      }

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
      window.location.href = "mesaj-yonetimi.php";
    };

    // Sayfa yüklendiğinde kullanıcıları getir
    console.log("🚀 Sayfa yüklendi, kullanıcılar getiriliyor...");
    $scope.kisileriGetir();
  })

  // ===== FILM DETAY CONTROLLER =====
  .controller("FilmDetayController", function ($scope, $http, $timeout) {
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");
    $scope.loading = true;
    $scope.error = null;
    $scope.film = null;
    $scope.yorumlar = [];
    $scope.yeniYorum = {
      yorum: "",
      puan: 0,
      spoiler: false,
    };

    // Film takip durumu
    $scope.filmTakipDurumu = {
      isFavorite: false,
      isWatched: false,
      isWatchlist: false,
    };
    $scope.takipLoading = false;

    // URL'den film ID'sini veya film adını al
    var urlParams = new URLSearchParams(window.location.search);
    var filmId = urlParams.get("id");
    var filmTitle = urlParams.get("title");

    if (!filmId && !filmTitle) {
      $scope.error = "Film ID'si veya film adı bulunamadı!";
      $scope.loading = false;
      return;
    }

    // Film detaylarını yükle
    $scope.filmDetayiniYukle = function () {
      var apiUrl = "api.php?films=1";
      if (filmId) {
        apiUrl += "&id=" + filmId;
      } else if (filmTitle) {
        apiUrl += "&title=" + encodeURIComponent(filmTitle);
      }

      $http
        .get(apiUrl)
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
      var yorumApiUrl = "api.php?yorum=1&tur=film";
      if (filmId) {
        yorumApiUrl += "&icerik_id=" + filmId;
      } else if (filmTitle) {
        yorumApiUrl += "&title=" + encodeURIComponent(filmTitle);
      }

      console.log(
        "🔍 Yorumlar getiriliyor... Film ID:",
        filmId,
        "Film Title:",
        filmTitle
      );
      console.log("🔍 API URL:", yorumApiUrl);

      $http
        .get(yorumApiUrl)
        .then(function (response) {
          console.log("📊 API'den gelen yorumlar:", response.data); // Debug log
          console.log("📊 Yorum sayısı:", response.data.length); // Debug log

          // Yorum verilerini temizle (gereksiz boşlukları kaldır)
          var temizlenmisYorumlar = (response.data || []).map(function (yorum) {
            return {
              ...yorum,
              yorum: yorum.yorum
                ? yorum.yorum.trim().replace(/\s+/g, " ")
                : yorum.yorum,
            };
          });

          $scope.yorumlar = temizlenmisYorumlar; // Handle null/undefined response
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

      // Karakter uyarısını gizle (başlangıçta)
      var karakterUyari = document.querySelector("#global-karakter-uyari");
      if (karakterUyari) {
        karakterUyari.classList.remove("show");
      }

      // Buton disabled durumunda ise işlemi durdur
      if (
        !$scope.yeniYorum.yorum ||
        $scope.yeniYorum.yorum.length < 10 ||
        !$scope.yeniYorum.puan ||
        $scope.yeniYorum.puan < 1
      ) {
        // Karakter uyarısını göster ve titreme animasyonu ekle
        console.log("🔍 Karakter uyarısı gösteriliyor...");

        // AngularJS digest cycle'ını bekle
        $timeout(function () {
          var karakterUyari = document.querySelector("#global-karakter-uyari");
          console.log("🔍 Bulunan element:", karakterUyari);

          if (karakterUyari) {
            console.log(
              "✅ Element bulundu, show ve shake sınıfı ekleniyor..."
            );
            karakterUyari.classList.add("show", "shake");

            // 3 saniye sonra uyarıyı gizle
            $timeout(function () {
              console.log("🔄 Karakter uyarısı gizleniyor...");
              karakterUyari.classList.remove("show");
            }, 3000);

            // Shake animasyonunu kaldır
            $timeout(function () {
              console.log("🔄 Shake sınıfı kaldırılıyor...");
              karakterUyari.classList.remove("shake");
            }, 500);
          } else {
            console.log("❌ Karakter uyarı elementi bulunamadı!");
          }
        }, 100);

        if (!$scope.yeniYorum.puan || $scope.yeniYorum.puan < 1) {
          alert("Lütfen bir puan seçin!");
        }
        return;
      }

      var yorumData = {
        kullanici_id: $scope.kullanici.id,
        kullanici_adi: $scope.kullanici.username,
        tur: "film",
        icerik_id: filmId,
        icerik_adi: $scope.film.film_adi,
        yorum: $scope.yeniYorum.yorum
          ? $scope.yeniYorum.yorum.trim()
          : $scope.yeniYorum.yorum,
        puan: $scope.yeniYorum.puan,
        spoiler: $scope.yeniYorum.spoiler ? 1 : 0,
      };

      console.log("📤 Gönderilecek yorum verisi:", yorumData); // Debug log

      $http
        .post("api.php?yorum=1", yorumData)
        .then(function (response) {
          console.log("✅ API yanıtı:", response.data); // Debug log
          if (response.data.success) {
            showMessage("Yorum başarıyla eklendi!", "success");
            // Formu temizle
            $scope.yeniYorum = {
              yorum: "",
              puan: 0,
              spoiler: false,
            };
            // Angular'ın değişiklikleri algılamasını sağla (güvenli)
            if (!$scope.$$phase && !$scope.$root.$$phase) {
              $scope.$apply();
            }
            // Yorumları yeniden yükle
            $scope.yorumlariGetir();
          } else {
            showMessage(
              "Yorum eklenirken hata: " + response.data.message,
              "error"
            );
          }
        })
        .catch(function (error) {
          console.error("❌ Yorum ekleme hatası:", error); // Debug log
          showMessage(
            "Yorum eklenirken hata oluştu: " + error.statusText,
            "error"
          );
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

    // Film takip durumunu kontrol et
    $scope.filmTakipDurumunuKontrolEt = function () {
      if (!$scope.kullanici || !$scope.film) return;

      $http
        .get("film_takip_api.php?user_id=" + $scope.kullanici.id)
        .then(function (response) {
          var filmler = response.data || [];
          var mevcutFilm = filmler.find(function (f) {
            return f.title.toLowerCase() === $scope.film.film_adi.toLowerCase();
          });

          if (mevcutFilm) {
            $scope.filmTakipDurumu = {
              isFavorite: mevcutFilm.isFavorite,
              isWatched: mevcutFilm.isWatched,
              isWatchlist: mevcutFilm.isWatchlist || false,
            };
          } else {
            $scope.filmTakipDurumu = {
              isFavorite: false,
              isWatched: false,
              isWatchlist: false,
            };
          }
        })
        .catch(function (error) {
          console.error("Film takip durumu kontrol edilirken hata:", error);
        });
    };

    // Favori durumunu değiştir
    $scope.toggleFavorite = function () {
      if (!$scope.kullanici || $scope.takipLoading) return;

      $scope.takipLoading = true;
      var filmData = {
        user_id: $scope.kullanici.id,
        title: $scope.film.film_adi,
        year: $scope.film.yil,
        genre: $scope.film.tur,
        poster: $scope.film.poster_url,
        isFavorite: !$scope.filmTakipDurumu.isFavorite,
        isWatched: $scope.filmTakipDurumu.isWatched,
        isWatchlist: $scope.filmTakipDurumu.isWatchlist, // İzlenecek durumunu koru
        rating: parseFloat($scope.film.imdb_puani) || 0, // IMDb puanını kullan
        review: "",
      };

      if ($scope.filmTakipDurumu.isFavorite) {
        // Favorilerden çıkar - eğer izlenecek değilse tamamen sil
        if (!$scope.filmTakipDurumu.isWatchlist) {
          // Film izlenecek değilse tamamen sil
          $http
            .delete(
              "film_takip_api.php?user_id=" +
                $scope.kullanici.id +
                "&title=" +
                encodeURIComponent($scope.film.film_adi)
            )
            .then(function (response) {
              if (response.data.success) {
                $scope.filmTakipDurumu.isFavorite = false;
                $scope.filmTakipDurumu.isWatchlist = false;
                showMessage("Film favorilerden çıkarıldı", "success");
              }
            })
            .catch(function (error) {
              showMessage("İşlem sırasında hata oluştu", "error");
            })
            .finally(function () {
              $scope.takipLoading = false;
            });
        } else {
          // Film izlenecek ise sadece favori durumunu güncelle
          $http
            .put("film_takip_api.php", filmData)
            .then(function (response) {
              if (response.data.success) {
                $scope.filmTakipDurumu.isFavorite = false;
                showMessage("Film favorilerden çıkarıldı", "success");
              }
            })
            .catch(function (error) {
              showMessage("İşlem sırasında hata oluştu", "error");
            })
            .finally(function () {
              $scope.takipLoading = false;
            });
        }
      } else {
        // Favorilere ekle
        $http
          .post("film_takip_api.php", filmData)
          .then(function (response) {
            if (response.data.success) {
              $scope.filmTakipDurumu.isFavorite = true;
              showMessage("Film favorilere eklendi", "success");
            }
          })
          .catch(function (error) {
            showMessage("İşlem sırasında hata oluştu", "error");
          })
          .finally(function () {
            $scope.takipLoading = false;
          });
      }
    };

    // İzlendi durumunu değiştir
    $scope.toggleWatched = function () {
      if (!$scope.kullanici || $scope.takipLoading) return;

      $scope.takipLoading = true;
      var filmData = {
        user_id: $scope.kullanici.id,
        title: $scope.film.film_adi,
        year: $scope.film.yil,
        genre: $scope.film.tur,
        poster: $scope.film.poster_url,
        isFavorite: $scope.filmTakipDurumu.isFavorite,
        isWatched: !$scope.filmTakipDurumu.isWatched,
        rating: parseFloat($scope.film.imdb_puani) || 0, // IMDb puanını kullan
        review: "",
      };

      if ($scope.filmTakipDurumu.isWatched) {
        // İzlendi durumunu kaldır
        $http
          .put("film_takip_api.php", filmData)
          .then(function (response) {
            if (response.data.success) {
              $scope.filmTakipDurumu.isWatched = false;
              // İzleneceklere otomatik ekleme kaldırıldı - kullanıcı manuel olarak seçsin
              showMessage("Film izlendi listesinden çıkarıldı", "success");
            }
          })
          .catch(function (error) {
            showMessage("İşlem sırasında hata oluştu", "error");
          })
          .finally(function () {
            $scope.takipLoading = false;
          });
      } else {
        // İzlendi olarak işaretle
        $http
          .post("film_takip_api.php", filmData)
          .then(function (response) {
            if (response.data.success) {
              $scope.filmTakipDurumu.isWatched = true;
              // İzleneceklerden otomatik çıkarma kaldırıldı - kullanıcı manuel karar versin
              showMessage("Film izlendi olarak işaretlendi", "success");
            }
          })
          .catch(function (error) {
            showMessage("İşlem sırasında hata oluştu", "error");
          })
          .finally(function () {
            $scope.takipLoading = false;
          });
      }
    };

    // İzlenecek durumunu değiştir
    $scope.toggleWatchlist = function () {
      if (!$scope.kullanici || $scope.takipLoading) return;

      $scope.takipLoading = true;
      var filmData = {
        user_id: $scope.kullanici.id,
        title: $scope.film.film_adi,
        year: $scope.film.yil,
        genre: $scope.film.tur,
        poster: $scope.film.poster_url,
        isFavorite: $scope.filmTakipDurumu.isFavorite,
        isWatched: $scope.filmTakipDurumu.isWatched, // Mevcut durumu koru
        isWatchlist: !$scope.filmTakipDurumu.isWatchlist, // Toggle watchlist
        rating: parseFloat($scope.film.imdb_puani) || 0, // IMDb puanını kullan
        review: "",
      };

      if ($scope.filmTakipDurumu.isWatchlist) {
        // İzleneceklerden çıkar - eğer favori değilse tamamen sil
        if (!$scope.filmTakipDurumu.isFavorite) {
          // Film favori değilse tamamen sil
          $http
            .delete(
              "film_takip_api.php?user_id=" +
                $scope.kullanici.id +
                "&title=" +
                encodeURIComponent($scope.film.film_adi)
            )
            .then(function (response) {
              if (response.data.success) {
                $scope.filmTakipDurumu.isWatchlist = false;
                // Favori durumunu otomatik değiştirme - sadece izleneceklerden çıkar
                showMessage(
                  "Film izlenecekler listesinden çıkarıldı",
                  "success"
                );
              }
            })
            .catch(function (error) {
              showMessage("İşlem sırasında hata oluştu", "error");
            })
            .finally(function () {
              $scope.takipLoading = false;
            });
        } else {
          // Film favori ise sadece watchlist durumunu güncelle
          $http
            .put("film_takip_api.php", filmData)
            .then(function (response) {
              if (response.data.success) {
                $scope.filmTakipDurumu.isWatchlist = false;
                showMessage(
                  "Film izlenecekler listesinden çıkarıldı",
                  "success"
                );
              }
            })
            .catch(function (error) {
              showMessage("İşlem sırasında hata oluştu", "error");
            })
            .finally(function () {
              $scope.takipLoading = false;
            });
        }
      } else {
        // İzleneceklere ekle
        $http
          .post("film_takip_api.php", filmData)
          .then(function (response) {
            if (response.data.success) {
              $scope.filmTakipDurumu.isWatchlist = true;
              // İzlendi durumunu otomatik değiştirme - kullanıcı manuel karar versin
              showMessage("Film izlenecekler listesine eklendi", "success");
            }
          })
          .catch(function (error) {
            showMessage("İşlem sırasında hata oluştu", "error");
          })
          .finally(function () {
            $scope.takipLoading = false;
          });
      }
    };

    // Sayfa yüklendiğinde film detaylarını yükle
    $scope.filmDetayiniYukle();

    // Film yüklendikten sonra takip durumunu kontrol et
    $scope.$watch("film", function (newVal) {
      if (newVal) {
        $scope.filmTakipDurumunuKontrolEt();
      }
    });

    // Yukarı çık fonksiyonu
    $scope.scrollToTop = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };
  })

  // Dizi Detay Controller
  .controller("DiziDetayController", function ($scope, $http, $timeout) {
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");
    $scope.loading = true;
    $scope.error = null;
    $scope.dizi = null;
    $scope.yorumlar = [];
    $scope.yeniYorum = {
      yorum: "",
      puan: 0,
      spoiler: false,
    };

    // Modal değişkenleri
    $scope.showWatchingModal = false;
    $scope.modalData = {
      currentSeason: 1,
      currentEpisode: 1
    };
    
    // Sezon bilgilerini cache'lemek için
    $scope.sezonCache = {};

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
            // Sezon bilgilerini yükle
            $scope.sezonBilgileriniYukle();
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
    
    // Sezon bilgilerini yükle ve cache'le
    $scope.sezonBilgileriniYukle = function() {
      if ($scope.dizi && $scope.dizi.id) {
        $http.get('dizi_sezon_api.php?dizi_id=' + $scope.dizi.id)
          .then(function(response) {
            if (response.data.success && response.data.sezonlar) {
              // Sezon bilgilerini cache'le
              response.data.sezonlar.forEach(function(sezon) {
                $scope.sezonCache[sezon.sezon_no] = sezon.bolum_sayisi;
              });
              console.log("✅ Sezon bilgileri yüklendi:", $scope.sezonCache);
            }
          })
          .catch(function(error) {
            console.log("ℹ️ Sezon bilgileri yüklenemedi, varsayılan değerler kullanılacak");
          });
      }
    };

    // Yorumları getir
    $scope.yorumlariGetir = function () {
      $http
        .get("api.php?yorum=1&tur=dizi&icerik_id=" + diziId)
        .then(function (response) {
          // Yorum verilerini temizle (gereksiz boşlukları kaldır)
          var temizlenmisYorumlar = (response.data || []).map(function (yorum) {
            return {
              ...yorum,
              yorum: yorum.yorum
                ? yorum.yorum.trim().replace(/\s+/g, " ")
                : yorum.yorum,
            };
          });

          $scope.yorumlar = temizlenmisYorumlar;
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

      // Karakter uyarısını gizle (başlangıçta)
      var karakterUyari = document.querySelector("#global-karakter-uyari");
      if (karakterUyari) {
        karakterUyari.classList.remove("show");
      }

      // Buton disabled durumunda ise işlemi durdur
      if (
        !$scope.yeniYorum.yorum ||
        $scope.yeniYorum.yorum.length < 10 ||
        !$scope.yeniYorum.puan ||
        $scope.yeniYorum.puan < 1
      ) {
        // Karakter uyarısını göster ve titreme animasyonu ekle
        console.log("🔍 Dizi: Karakter uyarısı gösteriliyor...");

        $timeout(function () {
          var karakterUyari = document.querySelector("#global-karakter-uyari");
          if (karakterUyari) {
            console.log(
              "✅ Dizi: Element bulundu, show ve shake sınıfı ekleniyor..."
            );
            karakterUyari.classList.add("show", "shake");

            // 3 saniye sonra uyarıyı gizle
            $timeout(function () {
              console.log("🔄 Dizi: Karakter uyarısı gizleniyor...");
              karakterUyari.classList.remove("show");
            }, 3000);

            // Shake animasyonunu kaldır
            $timeout(function () {
              karakterUyari.classList.remove("shake");
            }, 500);
          }
        }, 100);

        if (!$scope.yeniYorum.puan || $scope.yeniYorum.puan < 1) {
          alert("Lütfen bir puan seçin!");
          return;
        }

        // Karakter sınırı kontrolü için return ekle
        if (!$scope.yeniYorum.yorum || $scope.yeniYorum.yorum.length < 10) {
          return;
        }

        return;
      }

      var yorumData = {
        kullanici_id: $scope.kullanici.id,
        kullanici_adi: $scope.kullanici.username,
        tur: "dizi",
        icerik_id: diziId,
        icerik_adi: $scope.dizi.dizi_adi,
        yorum: $scope.yeniYorum.yorum
          ? $scope.yeniYorum.yorum.trim()
          : $scope.yeniYorum.yorum,
        puan: $scope.yeniYorum.puan,
        spoiler: $scope.yeniYorum.spoiler ? 1 : 0,
      };

      $http
        .post("api.php?yorum=1", yorumData)
        .then(function (response) {
          if (response.data.success) {
            showMessage("Yorum başarıyla eklendi!", "success");
            // Formu temizle
            $scope.yeniYorum = {
              yorum: "",
              puan: 0,
              spoiler: false,
            };
            // Yorumları yeniden yükle
            $scope.yorumlariGetir();
          } else {
            showMessage(
              "Yorum eklenirken hata: " + response.data.message,
              "error"
            );
          }
        })
        .catch(function (error) {
          showMessage(
            "Yorum eklenirken hata oluştu: " + error.statusText,
            "error"
          );
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

    // Dizi takip durumu
    $scope.diziTakipDurumu = {
      isFavorite: false,
      isWatched: false,
      isWatchlist: false,
      isWatching: false,
      current_season: 1,
      current_episode: 1,
    };
    $scope.takipLoading = false;

    // Dizi takip durumunu kontrol et
    $scope.diziTakipDurumuKontrolEt = function () {
      if (!$scope.kullanici || !$scope.dizi) return;

      $http
        .get("dizi_takip_api.php?user_id=" + $scope.kullanici.id)
        .then(function (response) {
          var diziler = response.data || [];
          var mevcutDizi = diziler.find(function (d) {
            return d.title.toLowerCase() === $scope.dizi.dizi_adi.toLowerCase();
          });

          if (mevcutDizi) {
            $scope.diziTakipDurumu = {
              isFavorite: mevcutDizi.isFavorite,
              isWatched: mevcutDizi.isWatched,
              isWatchlist: mevcutDizi.isWatchlist || false,
              isWatching: mevcutDizi.isWatching || false,
              current_season: mevcutDizi.current_season || 1,
              current_episode: mevcutDizi.current_episode || 1,
            };
          } else {
            $scope.diziTakipDurumu = {
              isFavorite: false,
              isWatched: false,
              isWatchlist: false,
              isWatching: false,
              current_season: 1,
              current_episode: 1,
            };
          }
        })
        .catch(function (error) {
          console.error("Dizi takip durumu kontrol edilirken hata:", error);
        });
    };

    // Favori durumunu değiştir
    $scope.toggleFavorite = function () {
      if (!$scope.kullanici || $scope.takipLoading) return;

      $scope.takipLoading = true;
      var diziData = {
        user_id: $scope.kullanici.id,
        title: $scope.dizi.dizi_adi,
        year: $scope.dizi.yil,
        genre: $scope.dizi.kategori,
        poster: $scope.dizi.poster_url,
        season_count: $scope.dizi.toplam_sezon_sayisi || 1,
        episode_count: $scope.dizi.toplam_bolum_sayisi || 1,
        current_season: $scope.diziTakipDurumu.current_season,
        current_episode: $scope.diziTakipDurumu.current_episode,
        isFavorite: !$scope.diziTakipDurumu.isFavorite,
        isWatched: $scope.diziTakipDurumu.isWatched,
        isWatchlist: $scope.diziTakipDurumu.isWatchlist,
        isWatching: $scope.diziTakipDurumu.isWatching,
        rating: parseFloat($scope.dizi.imdb_puani) || 0,
        review: "",
      };

      if ($scope.diziTakipDurumu.isFavorite) {
        // Favorilerden çıkar - eğer başka durum yoksa tamamen sil
        if (
          !$scope.diziTakipDurumu.isWatchlist &&
          !$scope.diziTakipDurumu.isWatching &&
          !$scope.diziTakipDurumu.isWatched
        ) {
          $http
            .delete(
              "dizi_takip_api.php?user_id=" +
                $scope.kullanici.id +
                "&title=" +
                encodeURIComponent($scope.dizi.dizi_adi)
            )
            .then(function (response) {
              if (response.data.success) {
                $scope.diziTakipDurumu.isFavorite = false;
                showMessage("Dizi favorilerden çıkarıldı", "success");
              } else {
                showMessage(
                  response.data.message || "İşlem başarısız",
                  "error"
                );
              }
              $scope.takipLoading = false;
            })
            .catch(function (error) {
              console.error("Dizi favorilerden çıkarılırken hata:", error);
              showMessage("İşlem başarısız", "error");
              $scope.takipLoading = false;
            });
        } else {
          // Sadece favori durumunu güncelle
          $http
            .put("dizi_takip_api.php", diziData)
            .then(function (response) {
              if (response.data.success) {
                $scope.diziTakipDurumu.isFavorite = false;
                showMessage("Dizi favorilerden çıkarıldı", "success");
              } else {
                showMessage(
                  response.data.message || "İşlem başarısız",
                  "error"
                );
              }
              $scope.takipLoading = false;
            })
            .catch(function (error) {
              console.error("Dizi güncellenirken hata:", error);
              showMessage("İşlem başarısız", "error");
              $scope.takipLoading = false;
            });
        }
      } else {
        // Favorilere ekle
        $http
          .post("dizi_takip_api.php", diziData)
          .then(function (response) {
            if (response.data.success) {
              $scope.diziTakipDurumu.isFavorite = true;
              showMessage("Dizi favorilere eklendi", "success");
            } else {
              showMessage(response.data.message || "İşlem başarısız", "error");
            }
            $scope.takipLoading = false;
          })
          .catch(function (error) {
            console.error("Dizi favorilere eklenirken hata:", error);
            showMessage("İşlem başarısız", "error");
            $scope.takipLoading = false;
          });
      }
    };

    // Modal fonksiyonları
    $scope.openWatchingModal = function() {
      if (!$scope.kullanici) {
        showMessage("Giriş yapmanız gerekiyor", "error");
        return;
      }

      // Mevcut değerleri modal'a yükle
      if ($scope.diziTakipDurumu.isWatching) {
        $scope.modalData.currentSeason = $scope.diziTakipDurumu.current_season || 1;
        $scope.modalData.currentEpisode = $scope.diziTakipDurumu.current_episode || 1;
      } else {
        $scope.modalData.currentSeason = 1;
        $scope.modalData.currentEpisode = 1;
      }
      
      $scope.showWatchingModal = true;
      
      console.log("✅ Modal açıldı");
    };

    $scope.closeWatchingModal = function() {
      $scope.showWatchingModal = false;
    };

    // Sezon ve bölüm değişikliklerini dinle
    $scope.$watch('modalData.currentSeason', function(newVal, oldVal) {
      if (newVal !== oldVal) {
        console.log("✅ Sezon değişti:", oldVal, "→", newVal);
      }
    });

    $scope.$watch('modalData.currentEpisode', function(newVal, oldVal) {
      if (newVal !== oldVal) {
        console.log("✅ Bölüm değişti:", oldVal, "→", newVal);
      }
    });

    // Sezon ve bölüm array'lerini oluştur
    $scope.getSeasonArray = function() {
      var seasons = [];
      var maxSeasons = $scope.dizi ? ($scope.dizi.toplam_sezon_sayisi || 10) : 10;
      for (var i = 1; i <= maxSeasons; i++) {
        seasons.push(i);
      }
      return seasons;
    };



    $scope.getEpisodeArray = function() {
      var episodes = [];
      var selectedSeason = $scope.modalData.currentSeason;
      var maxEpisodes = 20; // Varsayılan değer
      
      if ($scope.dizi && selectedSeason) {
        // Eğer sezon bilgisi cache'de varsa kullan
        if ($scope.sezonCache && $scope.sezonCache[selectedSeason]) {
          maxEpisodes = $scope.sezonCache[selectedSeason];
        } else {
          // Eğer sezon bilgisi yoksa, genel mantık kullan
          var toplamBolum = $scope.dizi.toplam_bolum_sayisi || 20;
          var toplamSezon = $scope.dizi.toplam_sezon_sayisi || 1;
          maxEpisodes = Math.ceil(toplamBolum / toplamSezon);
        }
      }
      
      // Bölüm array'ini oluştur
      for (var i = 1; i <= maxEpisodes; i++) {
        episodes.push(i);
      }
      
      return episodes;
    };

    // Sezon değiştiğinde bölüm seçimini sıfırla
    $scope.$watch('modalData.currentSeason', function(newVal, oldVal) {
      if (newVal !== oldVal && newVal) {
        $scope.modalData.currentEpisode = 1; // Bölüm seçimini sıfırla
        console.log("✅ Sezon değişti:", oldVal, "→", newVal);
      }
    });

    // Sezon değiştiğinde çağrılacak fonksiyon
    $scope.onSeasonChange = function() {
      // Bölüm seçimini sıfırla
      $scope.modalData.currentEpisode = 1;
      
      console.log("🎬 Sezon değişti, bölüm sayısı güncellendi:", 
        "Sezon:", $scope.modalData.currentSeason, 
        "Bölüm Sayısı:", $scope.getEpisodeArray().length
      );
    };

    $scope.confirmWatchingUpdate = function() {
      if (!$scope.modalData.currentSeason || !$scope.modalData.currentEpisode) {
        showMessage("Lütfen sezon ve bölüm numarasını girin", "error");
        return;
      }

      // Modal'dan alınan değerlerle toggleWatching'i çağır
      $scope.toggleWatchingWithData($scope.modalData.currentSeason, $scope.modalData.currentEpisode);
      $scope.closeWatchingModal();
    };

    // İzleniyor durumunu değiştir (yeni versiyon - modal'dan veri alır)
    $scope.toggleWatchingWithData = function(season, episode) {
      if (!$scope.kullanici || $scope.takipLoading) return;

      $scope.takipLoading = true;
      var diziData = {
        user_id: $scope.kullanici.id,
        title: $scope.dizi.dizi_adi,
        year: $scope.dizi.yil,
        genre: $scope.dizi.kategori,
        poster: $scope.dizi.poster_url,
        season_count: $scope.dizi.toplam_sezon_sayisi || 1,
        episode_count: $scope.dizi.toplam_bolum_sayisi || 1,
        current_season: season,
        current_episode: episode,
        isFavorite: $scope.diziTakipDurumu.isFavorite,
        isWatched: $scope.diziTakipDurumu.isWatched,
        isWatchlist: !$scope.diziTakipDurumu.isWatching
          ? false
          : $scope.diziTakipDurumu.isWatchlist, // İzleniyorsa watchlist'i kapat
        isWatching: !$scope.diziTakipDurumu.isWatching,
        rating: parseFloat($scope.dizi.imdb_puani) || 0,
        review: "",
      };

      $http
        .post("dizi_takip_api.php", diziData)
        .then(function (response) {
          if (response.data.success) {
            $scope.diziTakipDurumu.isWatching =
              !$scope.diziTakipDurumu.isWatching;
            if ($scope.diziTakipDurumu.isWatching) {
              $scope.diziTakipDurumu.isWatchlist = false;
              $scope.diziTakipDurumu.current_season = season;
              $scope.diziTakipDurumu.current_episode = episode;
              showMessage("Dizi izleniyor listesine eklendi (S" + season + "E" + episode + ")", "success");
            } else {
              showMessage("Dizi izleniyor listesinden çıkarıldı", "success");
            }
          } else {
            showMessage(response.data.message || "İşlem başarısız", "error");
          }
          $scope.takipLoading = false;
        })
        .catch(function (error) {
          console.error("Dizi izleniyor durumu güncellenirken hata:", error);
          showMessage("İşlem başarısız", "error");
          $scope.takipLoading = false;
        });
    };

    // İzlenecek durumunu değiştir
    $scope.toggleWatchlist = function () {
      if (!$scope.kullanici || $scope.takipLoading) return;

      $scope.takipLoading = true;
      var diziData = {
        user_id: $scope.kullanici.id,
        title: $scope.dizi.dizi_adi,
        year: $scope.dizi.yil,
        genre: $scope.dizi.kategori,
        poster: $scope.dizi.poster_url,
        season_count: $scope.dizi.toplam_sezon_sayisi || 1,
        episode_count: $scope.dizi.toplam_bolum_sayisi || 1,
        current_season: $scope.diziTakipDurumu.current_season,
        current_episode: $scope.diziTakipDurumu.current_episode,
        isFavorite: $scope.diziTakipDurumu.isFavorite,
        isWatched: $scope.diziTakipDurumu.isWatched,
        isWatchlist: !$scope.diziTakipDurumu.isWatchlist,
        isWatching: $scope.diziTakipDurumu.isWatching,
        rating: parseFloat($scope.dizi.imdb_puani) || 0,
        review: "",
      };

      if ($scope.diziTakipDurumu.isWatchlist) {
        // İzleneceklerden çıkar - eğer başka durum yoksa tamamen sil
        if (
          !$scope.diziTakipDurumu.isFavorite &&
          !$scope.diziTakipDurumu.isWatching &&
          !$scope.diziTakipDurumu.isWatched
        ) {
          $http
            .delete(
              "dizi_takip_api.php?user_id=" +
                $scope.kullanici.id +
                "&title=" +
                encodeURIComponent($scope.dizi.dizi_adi)
            )
            .then(function (response) {
              if (response.data.success) {
                $scope.diziTakipDurumu.isWatchlist = false;
                showMessage("Dizi izleneceklerden çıkarıldı", "success");
              } else {
                showMessage(
                  response.data.message || "İşlem başarısız",
                  "error"
                );
              }
              $scope.takipLoading = false;
            })
            .catch(function (error) {
              console.error("Dizi izleneceklerden çıkarılırken hata:", error);
              showMessage("İşlem başarısız", "error");
              $scope.takipLoading = false;
            });
        } else {
          // Sadece watchlist durumunu güncelle
          $http
            .put("dizi_takip_api.php", diziData)
            .then(function (response) {
              if (response.data.success) {
                $scope.diziTakipDurumu.isWatchlist = false;
                showMessage("Dizi izleneceklerden çıkarıldı", "success");
              } else {
                showMessage(
                  response.data.message || "İşlem başarısız",
                  "error"
                );
              }
              $scope.takipLoading = false;
            })
            .catch(function (error) {
              console.error("Dizi güncellenirken hata:", error);
              showMessage("İşlem başarısız", "error");
              $scope.takipLoading = false;
            });
        }
      } else {
        // İzleneceklere ekle
        $http
          .post("dizi_takip_api.php", diziData)
          .then(function (response) {
            if (response.data.success) {
              $scope.diziTakipDurumu.isWatchlist = true;
              showMessage("Dizi izleneceklere eklendi", "success");
            } else {
              showMessage(response.data.message || "İşlem başarısız", "error");
            }
            $scope.takipLoading = false;
          })
          .catch(function (error) {
            console.error("Dizi izleneceklere eklenirken hata:", error);
            showMessage("İşlem başarısız", "error");
            $scope.takipLoading = false;
          });
      }
    };

    // Tamamlandı durumunu değiştir
    $scope.toggleWatched = function () {
      if (!$scope.kullanici || $scope.takipLoading) return;

      $scope.takipLoading = true;
      var diziData = {
        user_id: $scope.kullanici.id,
        title: $scope.dizi.dizi_adi,
        year: $scope.dizi.yil,
        genre: $scope.dizi.kategori,
        poster: $scope.dizi.poster_url,
        season_count: $scope.dizi.toplam_sezon_sayisi || 1,
        episode_count: $scope.dizi.toplam_bolum_sayisi || 1,
        current_season: $scope.dizi.toplam_sezon_sayisi || 1,
        current_episode: $scope.dizi.toplam_bolum_sayisi || 1,
        isFavorite: $scope.diziTakipDurumu.isFavorite,
        isWatched: !$scope.diziTakipDurumu.isWatched,
        isWatchlist: false, // Tamamlanmışsa watchlist'i kapat
        isWatching: false, // Tamamlanmışsa izleniyor durumunu kapat
        rating: parseFloat($scope.dizi.imdb_puani) || 0,
        review: "",
      };

      $http
        .post("dizi_takip_api.php", diziData)
        .then(function (response) {
          if (response.data.success) {
            $scope.diziTakipDurumu.isWatched =
              !$scope.diziTakipDurumu.isWatched;
            if ($scope.diziTakipDurumu.isWatched) {
              $scope.diziTakipDurumu.isWatching = false;
              $scope.diziTakipDurumu.isWatchlist = false;
              $scope.diziTakipDurumu.current_season =
                $scope.dizi.toplam_sezon_sayisi || 1;
              $scope.diziTakipDurumu.current_episode =
                $scope.dizi.toplam_bolum_sayisi || 1;
              showMessage("Dizi tamamlandı olarak işaretlendi", "success");
            } else {
              showMessage("Dizi tamamlandı listesinden çıkarıldı", "success");
            }
          } else {
            showMessage(response.data.message || "İşlem başarısız", "error");
          }
          $scope.takipLoading = false;
        })
        .catch(function (error) {
          console.error("Dizi tamamlandı durumu güncellenirken hata:", error);
          showMessage("İşlem başarısız", "error");
          $scope.takipLoading = false;
        });
    };

    // Mesaj gösterme fonksiyonu
    function showMessage(message, type) {
      const messageDiv = document.createElement("div");
      messageDiv.className = `message ${type}`;
      messageDiv.textContent = message;
      messageDiv.style.cssText = `
      position: fixed;
      top: 20px;
      right: 20px;
      padding: 15px 25px;
      border-radius: 8px;
      color: white;
      font-weight: 600;
      z-index: 10001;
      animation: slideIn 0.3s ease;
    `;

      if (type === "success") {
        messageDiv.style.background = "#51cf66";
      } else if (type === "error") {
        messageDiv.style.background = "#ff6b6b";
      } else if (type === "warning") {
        messageDiv.style.background = "#ffd43b";
        messageDiv.style.color = "#333";
      }

      document.body.appendChild(messageDiv);

      setTimeout(() => {
        messageDiv.remove();
      }, 3000);
    }

    // Sayfa yüklendiğinde dizi detaylarını yükle
    $scope.diziDetayiniYukle();

    // Dizi yüklendikten sonra takip durumunu kontrol et
    $scope.$watch("dizi", function (newVal) {
      if (newVal) {
        $scope.diziTakipDurumuKontrolEt();
      }
    });

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
          // Yorum verilerini temizle (gereksiz boşlukları kaldır)
          var temizlenmisYorumlar = (response.data || []).map(function (yorum) {
            return {
              ...yorum,
              yorum: yorum.yorum
                ? yorum.yorum.trim().replace(/\s+/g, " ")
                : yorum.yorum,
            };
          });

          $scope.yorumlar = temizlenmisYorumlar;
          $scope.filteredYorumlar = temizlenmisYorumlar;
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
    $scope.filteredMesajlar = [];
    $scope.currentPage = 1;
    $scope.itemsPerPage = 10;
    $scope.searchText = "";

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
            $scope.filteredMesajlar = response.data;
            console.log(
              "✅ Mesajlar yüklendi. Toplam:",
              $scope.mesajlar.length
            );
            console.log("📋 Mesaj listesi:", $scope.mesajlar);
          } else {
            $scope.mesajlar = [];
            $scope.filteredMesajlar = [];
            console.error("❌ Mesajlar yüklenirken hata:", response.data.error);
          }
        })
        .catch(function (error) {
          console.error("❌ Mesajlar yüklenirken hata:", error);
          $scope.mesajlar = [];
        });
    };

    // Arama ve filtreleme
    $scope.filterMessages = function () {
      if (!$scope.searchText || $scope.searchText.trim() === "") {
        $scope.filteredMesajlar = $scope.mesajlar;
      } else {
        var searchTerm = $scope.searchText.toLowerCase();
        $scope.filteredMesajlar = $scope.mesajlar.filter(function (mesaj) {
          return (
            (mesaj.adisoyadi &&
              mesaj.adisoyadi.toLowerCase().includes(searchTerm)) ||
            (mesaj.eposta && mesaj.eposta.toLowerCase().includes(searchTerm)) ||
            (mesaj.konu && mesaj.konu.toLowerCase().includes(searchTerm)) ||
            (mesaj.mesaj && mesaj.mesaj.toLowerCase().includes(searchTerm))
          );
        });
      }
      $scope.currentPage = 1; // Arama yapıldığında ilk sayfaya dön
    };

    // Sayfalama fonksiyonları
    $scope.totalPages = function () {
      return Math.ceil($scope.filteredMesajlar.length / $scope.itemsPerPage);
    };

    $scope.previousPage = function () {
      if ($scope.currentPage > 1) {
        $scope.currentPage--;
      }
    };

    $scope.nextPage = function () {
      if ($scope.currentPage < $scope.totalPages()) {
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
  })

  // ===== MİMARİ CONTROLLER =====
  .controller("MimariController", function ($scope, $http) {
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");

    $scope.mimariEserler = [];
    $scope.loading = true;
    $scope.apiError = null;

    // Veritabanından mimari eserleri yükle
    $scope.loadMimariEserler = function () {
      $scope.loading = true;
      $scope.apiError = null;

      console.log("🔄 Mimari eserler yükleniyor...");
      console.log("📡 API URL: api.php?mimari=1");

      $http
        .get("api.php?mimari=1")
        .then(function (response) {
          console.log("📥 API yanıtı alındı:", response);
          console.log("📊 Response data:", response.data);

          if (response.data && Array.isArray(response.data)) {
            $scope.mimariEserler = response.data;
            console.log("✅ Mimari eserler yüklendi:", $scope.mimariEserler);
            console.log(
              "📈 Yüklenen eser sayısı:",
              $scope.mimariEserler.length
            );
          } else {
            console.warn("⚠️ API yanıtı array değil:", response.data);
            $scope.mimariEserler = [];
          }

          $scope.loading = false;
        })
        .catch(function (error) {
          console.error("❌ Mimari eserler yüklenirken hata:", error);
          console.error("🔍 Hata detayları:", {
            status: error.status,
            statusText: error.statusText,
            data: error.data,
            config: error.config,
          });

          $scope.loading = false;
          $scope.apiError = error.statusText || "API bağlantı hatası";

          // Hata durumunda varsayılan verileri kullan
          $scope.mimariEserler = [
            {
              id: 1,
              ad: "Tac Mahal",
              mimar: "Ustad Ahmad Lahauri",
              tarih: "1632-1653",
              yer: "Agra, Hindistan",
              stil: "Mughal Mimari",
              aciklama:
                "Beyaz mermerden inşa edilmiş bu muhteşem anıt mezar, dünya mimarisinin en güzel örneklerinden biridir.",
              resim:
                "https://images.unsplash.com/photo-1564507592333-c60657eea523?w=800&h=600&fit=crop",
            },
          ];
        });
    };

    // Sayfa yüklendiğinde verileri yükle
    $scope.loadMimariEserler();

    $scope.eserDetay = function (eser) {
      // Eser detay sayfasına yönlendirme
      window.location.href = "mimari-detay.html?id=" + eser.id;
    };

    $scope.geriDon = function () {
      window.location.href = "sanat-kategoriler.html";
    };

    $scope.scrollToTop = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };
  })

  // ===== MİMARİ DETAY CONTROLLER =====
  .controller("MimariDetayController", function ($scope, $http, $location) {
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");

    $scope.eser = null;
    $scope.loading = true;

    // URL'den eser ID'sini al
    var urlParams = new URLSearchParams(window.location.search);
    var eserId = urlParams.get("id");

    if (eserId) {
      // Veritabanından eser detayını yükle
      $http
        .get("api.php?mimari=1&id=" + eserId)
        .then(function (response) {
          $scope.eser = response.data;
          $scope.loading = false;
          console.log("✅ Eser detayı yüklendi:", $scope.eser);

          // Sayfa başlığını güncelle
          document.title = $scope.eser.ad + " - Mimari Detay - GLOW";
        })
        .catch(function (error) {
          console.error("❌ Eser detayı yüklenirken hata:", error);
          $scope.loading = false;
          $scope.eser = null;
        });
    } else {
      $scope.loading = false;
      $scope.eser = null;
    }

    $scope.geriDon = function () {
      window.location.href = "mimari.html";
    };

    $scope.scrollToTop = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };
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

// ===== FUTBOL DETAY CONTROLLER =====
angular
  .module("GirisApp")
  .controller("FutbolDetayController", function ($scope) {
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");

    // Slider değişkenleri
    $scope.currentSlide = 0;
    $scope.totalSlides = 6;
    $scope.slidesPerView = 3;

    // Tab değiştirme fonksiyonu
    $scope.tabSec = function (tabName) {
      // Tüm tab butonlarından active class'ını kaldır
      document.querySelectorAll(".tab-btn").forEach((btn) => {
        btn.classList.remove("active");
      });

      // Tüm content section'ları gizle
      document.querySelectorAll(".content-section").forEach((section) => {
        section.classList.remove("active");
      });

      // Seçilen tab butonunu aktif yap
      event.target.classList.add("active");

      // Seçilen content section'ı göster
      document.getElementById(tabName).classList.add("active");
    };

    // Slider fonksiyonları
    $scope.nextSlide = function () {
      if ($scope.currentSlide < $scope.totalSlides - $scope.slidesPerView) {
        $scope.currentSlide++;
      } else {
        // Son kartta ise başa dön
        $scope.currentSlide = 0;
      }
      updateSlider();
    };

    $scope.prevSlide = function () {
      if ($scope.currentSlide > 0) {
        $scope.currentSlide--;
      } else {
        // İlk kartta ise sona git
        $scope.currentSlide = $scope.totalSlides - $scope.slidesPerView;
      }
      updateSlider();
    };

    $scope.goToSlide = function (index) {
      $scope.currentSlide = index;
      updateSlider();
    };

    function updateSlider() {
      const slider = document.getElementById("playerSlider");
      const cardWidth = 300; // card width + gap
      const translateX = -$scope.currentSlide * cardWidth;

      if (slider) {
        slider.style.transform = `translateX(${translateX}px)`;
      }

      // Buton durumlarını güncelle (sürekli döngü için disabled yok)
      const prevBtn = document.getElementById("prevBtn");
      const nextBtn = document.getElementById("nextBtn");

      if (prevBtn) {
        prevBtn.disabled = false;
      }

      if (nextBtn) {
        nextBtn.disabled = false;
      }

      // Dots'ları güncelle
      updateDots();
    }

    function updateDots() {
      const dots = document.querySelectorAll(".dot");
      dots.forEach((dot, index) => {
        if (index === $scope.currentSlide) {
          dot.classList.add("active");
        } else {
          dot.classList.remove("active");
        }
      });
    }

    // Mobil cihazlar için slidesPerView ayarı
    function checkMobile() {
      if (window.innerWidth <= 768) {
        $scope.slidesPerView = 1;
      } else if (window.innerWidth <= 1024) {
        $scope.slidesPerView = 2;
      } else {
        $scope.slidesPerView = 3;
      }
    }

    // Sayfa yüklendiğinde ve resize olduğunda kontrol et
    checkMobile();
    window.addEventListener("resize", function () {
      checkMobile();
      updateSlider();
    });

    $scope.scrollToTop = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };
  });

// ===== BASKETBOL DETAY CONTROLLER =====
angular
  .module("GirisApp")
  .controller("BasketbolDetayController", function ($scope) {
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");

    // Slider değişkenleri
    $scope.currentSlide = 0;
    $scope.totalSlides = 6;
    $scope.slidesPerView = 3;

    // Tab değiştirme fonksiyonu
    $scope.tabSec = function (tabName) {
      // Tüm tab butonlarından active class'ını kaldır
      document.querySelectorAll(".tab-btn").forEach((btn) => {
        btn.classList.remove("active");
      });

      // Tüm content section'ları gizle
      document.querySelectorAll(".content-section").forEach((section) => {
        section.classList.remove("active");
      });

      // Seçilen tab butonunu aktif yap
      event.target.classList.add("active");

      // Seçilen content section'ı göster
      document.getElementById(tabName).classList.add("active");
    };

    // Slider fonksiyonları
    $scope.nextSlide = function () {
      if ($scope.currentSlide < $scope.totalSlides - $scope.slidesPerView) {
        $scope.currentSlide++;
      } else {
        // Son kartta ise başa dön
        $scope.currentSlide = 0;
      }
      updateSlider();
    };

    $scope.prevSlide = function () {
      if ($scope.currentSlide > 0) {
        $scope.currentSlide--;
      } else {
        // İlk kartta ise sona git
        $scope.currentSlide = $scope.totalSlides - $scope.slidesPerView;
      }
      updateSlider();
    };

    $scope.goToSlide = function (index) {
      $scope.currentSlide = index;
      updateSlider();
    };

    function updateSlider() {
      const slider = document.getElementById("playerSlider");
      const cardWidth = 300; // card width + gap
      const translateX = -$scope.currentSlide * cardWidth;

      if (slider) {
        slider.style.transform = `translateX(${translateX}px)`;
      }

      // Buton durumlarını güncelle (sürekli döngü için disabled yok)
      const prevBtn = document.getElementById("prevBtn");
      const nextBtn = document.getElementById("nextBtn");

      if (prevBtn) {
        prevBtn.disabled = false;
      }

      if (nextBtn) {
        nextBtn.disabled = false;
      }

      // Dots'ları güncelle
      updateDots();
    }

    function updateDots() {
      const dots = document.querySelectorAll(".dot");
      dots.forEach((dot, index) => {
        if (index === $scope.currentSlide) {
          dot.classList.add("active");
        } else {
          dot.classList.remove("active");
        }
      });
    }

    // Mobil cihazlar için slidesPerView ayarı
    function checkMobile() {
      if (window.innerWidth <= 768) {
        $scope.slidesPerView = 1;
      } else if (window.innerWidth <= 1024) {
        $scope.slidesPerView = 2;
      } else {
        $scope.slidesPerView = 3;
      }
    }

    // Sayfa yüklendiğinde ve resize olduğunda kontrol et
    checkMobile();
    window.addEventListener("resize", function () {
      checkMobile();
      updateSlider();
    });

    $scope.scrollToTop = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };
  });

// ===== VOLEYBOL DETAY CONTROLLER =====
angular
  .module("GirisApp")
  .controller("VoleybolDetayController", function ($scope) {
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");

    // Tab değiştirme fonksiyonu
    $scope.tabSec = function (tabName) {
      // Tüm tab butonlarından active class'ını kaldır
      document.querySelectorAll(".tab-btn").forEach((btn) => {
        btn.classList.remove("active");
      });

      // Tüm content section'ları gizle
      document.querySelectorAll(".content-section").forEach((section) => {
        section.classList.remove("active");
      });

      // Seçilen tab butonunu aktif yap
      event.target.classList.add("active");

      // Seçilen content section'ı göster
      document.getElementById(tabName).classList.add("active");
    };

    $scope.scrollToTop = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };
  });

// ===== FITNESS DETAY CONTROLLER =====
angular
  .module("GirisApp")
  .controller("FitnessDetayController", function ($scope) {
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");

    // Tab değiştirme fonksiyonu
    $scope.tabSec = function (tabName) {
      // Tüm tab butonlarından active class'ını kaldır
      document.querySelectorAll(".tab-btn").forEach((btn) => {
        btn.classList.remove("active");
      });

      // Tüm content section'ları gizle
      document.querySelectorAll(".content-section").forEach((section) => {
        section.classList.remove("active");
      });

      // Seçilen tab butonunu aktif yap
      event.target.classList.add("active");

      // Seçilen content section'ı göster
      document.getElementById(tabName).classList.add("active");
    };

    $scope.scrollToTop = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };
  });

// ===== TENIS DETAY CONTROLLER =====
angular
  .module("GirisApp")
  .controller("TenisDetayController", function ($scope) {
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");

    // Slider değişkenleri
    $scope.currentSlide = 0;
    $scope.totalSlides = 6;
    $scope.slidesPerView = 3;

    // Tab değiştirme fonksiyonu
    $scope.tabSec = function (tabName) {
      document.querySelectorAll(".tab-btn").forEach((btn) => {
        btn.classList.remove("active");
      });
      document.querySelectorAll(".content-section").forEach((section) => {
        section.classList.remove("active");
      });
      event.target.classList.add("active");
      document.getElementById(tabName).classList.add("active");
    };

    // Slider fonksiyonları
    $scope.nextSlide = function () {
      if ($scope.currentSlide < $scope.totalSlides - $scope.slidesPerView) {
        $scope.currentSlide++;
      } else {
        $scope.currentSlide = 0;
      }
      updateSlider();
    };

    $scope.prevSlide = function () {
      if ($scope.currentSlide > 0) {
        $scope.currentSlide--;
      } else {
        $scope.currentSlide = $scope.totalSlides - $scope.slidesPerView;
      }
      updateSlider();
    };

    $scope.goToSlide = function (index) {
      $scope.currentSlide = index;
      updateSlider();
    };

    function updateSlider() {
      const slider = document.getElementById("playerSlider");
      const cardWidth = 300; // card width + gap
      const translateX = -$scope.currentSlide * cardWidth;

      if (slider) {
        slider.style.transform = `translateX(${translateX}px)`;
      }

      const prevBtn = document.getElementById("prevBtn");
      const nextBtn = document.getElementById("nextBtn");

      if (prevBtn) {
        prevBtn.disabled = false;
      }
      if (nextBtn) {
        nextBtn.disabled = false;
      }
      updateDots();
    }

    function updateDots() {
      const dots = document.querySelectorAll(".dot");
      dots.forEach((dot, index) => {
        if (index === $scope.currentSlide) {
          dot.classList.add("active");
        } else {
          dot.classList.remove("active");
        }
      });
    }

    function checkMobile() {
      if (window.innerWidth <= 768) {
        $scope.slidesPerView = 1;
      } else if (window.innerWidth <= 1024) {
        $scope.slidesPerView = 2;
      } else {
        $scope.slidesPerView = 3;
      }
    }

    checkMobile();
    window.addEventListener("resize", function () {
      checkMobile();
      updateSlider();
    });

    $scope.scrollToTop = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };
  });

// ===== YOGA DETAY CONTROLLER =====
angular.module("GirisApp").controller("YogaDetayController", function ($scope) {
  $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");

  // Tab değiştirme fonksiyonu
  $scope.tabSec = function (tabName) {
    document.querySelectorAll(".tab-btn").forEach((btn) => {
      btn.classList.remove("active");
    });
    document.querySelectorAll(".content-section").forEach((section) => {
      section.classList.remove("active");
    });
    event.target.classList.add("active");
    document.getElementById(tabName).classList.add("active");
  };

  $scope.scrollToTop = function () {
    window.scrollTo({ top: 0, behavior: "smooth" });
  };
});

// ===== BOKS DETAY CONTROLLER =====
angular.module("GirisApp").controller("BoksDetayController", function ($scope) {
  $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");

  // Slider değişkenleri
  $scope.currentSlide = 0;
  $scope.totalSlides = 6;
  $scope.slidesPerView = 3;

  // Tab değiştirme fonksiyonu
  $scope.tabSec = function (tabName) {
    document.querySelectorAll(".tab-btn").forEach((btn) => {
      btn.classList.remove("active");
    });
    document.querySelectorAll(".content-section").forEach((section) => {
      section.classList.remove("active");
    });
    event.target.classList.add("active");
    document.getElementById(tabName).classList.add("active");
  };

  // Slider fonksiyonları
  $scope.nextSlide = function () {
    if ($scope.currentSlide < $scope.totalSlides - $scope.slidesPerView) {
      $scope.currentSlide++;
    } else {
      $scope.currentSlide = 0;
    }
    updateSlider();
  };

  $scope.prevSlide = function () {
    if ($scope.currentSlide > 0) {
      $scope.currentSlide--;
    } else {
      $scope.currentSlide = $scope.totalSlides - $scope.slidesPerView;
    }
    updateSlider();
  };

  $scope.goToSlide = function (index) {
    $scope.currentSlide = index;
    updateSlider();
  };

  function updateSlider() {
    const slider = document.getElementById("playerSlider");
    const cardWidth = 300; // card width + gap
    const translateX = -$scope.currentSlide * cardWidth;

    if (slider) {
      slider.style.transform = `translateX(${translateX}px)`;
    }

    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    if (prevBtn) {
      prevBtn.disabled = false;
    }
    if (nextBtn) {
      nextBtn.disabled = false;
    }
    updateDots();
  }

  function updateDots() {
    const dots = document.querySelectorAll(".dot");
    dots.forEach((dot, index) => {
      if (index === $scope.currentSlide) {
        dot.classList.add("active");
      } else {
        dot.classList.remove("active");
      }
    });
  }

  function checkMobile() {
    if (window.innerWidth <= 768) {
      $scope.slidesPerView = 1;
    } else if (window.innerWidth <= 1024) {
      $scope.slidesPerView = 2;
    } else {
      $scope.slidesPerView = 3;
    }
  }

  checkMobile();
  window.addEventListener("resize", function () {
    checkMobile();
    updateSlider();
  });

  $scope.scrollToTop = function () {
    window.scrollTo({ top: 0, behavior: "smooth" });
  };
});

// ===== FILM TAKIP CONTROLLER =====
angular
  .module("GirisApp")
  .controller("FilmTakipController", function ($scope, $http) {
    // Kullanıcı kontrolü
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");

    if (!$scope.kullanici) {
      window.location.href = "index.html";
      return;
    }

    // Film listesi
    $scope.films = [];
    $scope.filteredFilms = [];
    $scope.activeFilter = "all";
    $scope.searchText = "";

    // Modal durumları
    $scope.showAddFilmModal = false;
    $scope.showFilmDetailModal = false;
    $scope.selectedFilm = null;

    // Yeni film formu
    $scope.newFilm = {
      title: "",
      year: new Date().getFullYear(),
      genre: "",
      poster: "",
      rating: 0,
      review: "",
      isWatched: false,
      isFavorite: false,
    };

    // İstatistikler
    $scope.stats = {
      izlenen: 0,
      izlenecek: 0,
      favori: 0,
      ortalama: 0,
    };

    // Filmleri yükle
    $scope.loadFilms = function () {
      $http
        .get("film_takip_api.php?user_id=" + $scope.kullanici.id)
        .then(function (response) {
          $scope.films = response.data;
          $scope.updateFilteredFilms();
          $scope.updateStats();
        })
        .catch(function (error) {
          console.error("Filmler yüklenirken hata:", error);
          showMessage("Filmler yüklenirken hata oluştu", "error");
        });
    };

    // Filtrelenmiş filmleri güncelle
    $scope.updateFilteredFilms = function () {
      switch ($scope.activeFilter) {
        case "watched":
          $scope.filteredFilms = $scope.films.filter((film) => film.isWatched);
          break;
        case "watchlist":
          $scope.filteredFilms = $scope.films.filter(
            (film) => film.isWatchlist
          );
          break;
        case "favorite":
          $scope.filteredFilms = $scope.films.filter((film) => film.isFavorite);
          break;
        default:
          $scope.filteredFilms = $scope.films;
      }
    };

    // İstatistikleri güncelle
    $scope.updateStats = function () {
      $scope.stats.izlenen = $scope.films.filter(
        (film) => film.isWatched
      ).length;
      $scope.stats.izlenecek = $scope.films.filter(
        (film) => film.isWatchlist
      ).length;
      $scope.stats.favori = $scope.films.filter(
        (film) => film.isFavorite
      ).length;

      const ratedFilms = $scope.films.filter((film) => film.rating > 0);
      if (ratedFilms.length > 0) {
        const totalRating = ratedFilms.reduce(
          (sum, film) => sum + parseFloat(film.rating),
          0
        );
        $scope.stats.ortalama = (totalRating / ratedFilms.length).toFixed(1);
      } else {
        $scope.stats.ortalama = "0.0";
      }
    };

    // Filtre değiştir
    $scope.setFilter = function (filter) {
      $scope.activeFilter = filter;
      $scope.updateFilteredFilms();
    };

    // Favori durumunu değiştir
    $scope.toggleFavorite = function (film) {
      film.isFavorite = !film.isFavorite;
      $scope.updateFilm(film);
    };

    // İzleme durumunu değiştir
    $scope.toggleWatchStatus = function (film) {
      film.isWatched = !film.isWatched;
      $scope.updateFilm(film);
    };

    // İzlenecek durumunu değiştir
    $scope.toggleWatchlist = function (film) {
      film.isWatchlist = !film.isWatchlist;
      $scope.updateFilm(film);
    };

    // Film güncelle
    $scope.updateFilm = function (film) {
      $http
        .put("film_takip_api.php", film)
        .then(function (response) {
          if (response.data.success) {
            $scope.updateStats();
          } else {
            showMessage(
              response.data.message || "Film güncellenirken hata oluştu",
              "error"
            );
          }
        })
        .catch(function (error) {
          console.error("Film güncellenirken hata:", error);
          showMessage("Film güncellenirken hata oluştu", "error");
        });
    };

    // Film detayını aç
    $scope.openFilmDetail = function (film) {
      // Film detay sayfasına yönlendir
      if (film.film_id) {
        window.location.href = "film-detay.html?id=" + film.film_id;
      } else {
        // Eğer film_id yoksa film adına göre arama yap
        window.location.href =
          "film-detay.html?title=" + encodeURIComponent(film.title);
      }
    };

    // Mesaj gösterme fonksiyonu
    function showMessage(message, type) {
      const messageDiv = document.createElement("div");
      messageDiv.className = `message ${type}`;
      messageDiv.textContent = message;
      messageDiv.style.cssText = `
      position: fixed;
      top: 20px;
      right: 20px;
      padding: 15px 25px;
      border-radius: 8px;
      color: white;
      font-weight: 600;
      z-index: 10001;
      animation: slideIn 0.3s ease;
    `;

      if (type === "success") {
        messageDiv.style.background = "#51cf66";
      } else {
        messageDiv.style.background = "#ff6b6b";
      }

      document.body.appendChild(messageDiv);

      setTimeout(() => {
        messageDiv.style.animation = "slideOut 0.3s ease";
        setTimeout(() => {
          document.body.removeChild(messageDiv);
        }, 300);
      }, 3000);
    }

    // CSS animasyonları
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

    // Sayfa yüklendiğinde filmleri yükle
    $scope.loadFilms();
  });

// ===== DİZİ TAKIP CONTROLLER =====
angular
  .module("GirisApp")
  .controller("DiziTakipController", function ($scope, $http) {
    // Kullanıcı kontrolü
    $scope.kullanici = JSON.parse(localStorage.getItem("girisYapan") || "null");

    if (!$scope.kullanici) {
      window.location.href = "index.html";
      return;
    }

    // Dizi listesi
    $scope.dizis = [];
    $scope.filteredDizis = [];
    $scope.activeFilter = "favorite"; // Sayfa yüklendiğinde Favoriler seçili olsun
    $scope.searchText = "";

    // Modal durumları
    $scope.showAddDiziModal = false;
    $scope.showDiziDetailModal = false;
    $scope.selectedDizi = null;

    // Yeni dizi formu
    $scope.newDizi = {
      title: "",
      year: new Date().getFullYear(),
      genre: "",
      poster: "",
      rating: 0,
      review: "",
      season_count: 1,
      episode_count: 1,
      current_season: 1,
      current_episode: 1,
      isWatched: false,
      isFavorite: false,
      isWatchlist: false,
      isWatching: false,
    };

    // İstatistikler
    $scope.stats = {
      izlenen: 0,
      izleniyor: 0,
      izlenecek: 0,
      favori: 0,
      ortalama: 0,
    };

    // Dizileri yükle
    $scope.loadDizis = function () {
      $http
        .get("dizi_takip_api.php?user_id=" + $scope.kullanici.id)
        .then(function (response) {
          $scope.dizis = response.data;
          $scope.updateFilteredDizis();
          $scope.updateStats();
        })
        .catch(function (error) {
          console.error("Diziler yüklenirken hata:", error);
          showMessage("Diziler yüklenirken hata oluştu", "error");
        });
    };

    // Filtrelenmiş dizileri güncelle
    $scope.updateFilteredDizis = function () {
      switch ($scope.activeFilter) {
        case "watching":
          $scope.filteredDizis = $scope.dizis.filter((dizi) => dizi.isWatching);
          break;
        case "watched":
          $scope.filteredDizis = $scope.dizis.filter((dizi) => dizi.isWatched);
          break;
        case "watchlist":
          $scope.filteredDizis = $scope.dizis.filter(
            (dizi) => dizi.isWatchlist
          );
          break;
        case "favorite":
          $scope.filteredDizis = $scope.dizis.filter((dizi) => dizi.isFavorite);
          break;
        default:
          $scope.filteredDizis = $scope.dizis.filter((dizi) => dizi.isFavorite); // Default olarak favoriler gösterilsin
      }
    };

    // İstatistikleri güncelle
    $scope.updateStats = function () {
      $scope.stats.izlenen = $scope.dizis.filter(
        (dizi) => dizi.isWatched
      ).length;
      $scope.stats.izleniyor = $scope.dizis.filter(
        (dizi) => dizi.isWatching
      ).length;
      $scope.stats.izlenecek = $scope.dizis.filter(
        (dizi) => dizi.isWatchlist
      ).length;
      $scope.stats.favori = $scope.dizis.filter(
        (dizi) => dizi.isFavorite
      ).length;

      const ratedDizis = $scope.dizis.filter((dizi) => dizi.rating > 0);
      if (ratedDizis.length > 0) {
        const totalRating = ratedDizis.reduce(
          (sum, dizi) => sum + parseFloat(dizi.rating),
          0
        );
        $scope.stats.ortalama = (totalRating / ratedDizis.length).toFixed(1);
      } else {
        $scope.stats.ortalama = "0.0";
      }
    };

    // Filtre değiştir
    $scope.setFilter = function (filter) {
      $scope.activeFilter = filter;
      $scope.updateFilteredDizis();
    };

    // Favori durumunu değiştir
    $scope.toggleFavorite = function (dizi) {
      dizi.isFavorite = !dizi.isFavorite;
      $scope.updateDizi(dizi);
    };

    // İzleme durumunu değiştir
    $scope.toggleWatchStatus = function (dizi) {
      dizi.isWatched = !dizi.isWatched;
      if (dizi.isWatched) {
        dizi.isWatching = false; // Tamamlanmışsa izleniyor durumunu kapat
      }
      $scope.updateDizi(dizi);
    };

    // İzlenecek durumunu değiştir
    $scope.toggleWatchlist = function (dizi) {
      dizi.isWatchlist = !dizi.isWatchlist;
      $scope.updateDizi(dizi);
    };

    // İzleniyor durumunu değiştir
    $scope.toggleWatchingStatus = function (dizi) {
      dizi.isWatching = !dizi.isWatching;
      if (dizi.isWatching) {
        dizi.isWatched = false; // İzleniyorsa tamamlandı durumunu kapat
        dizi.isWatchlist = false; // İzleniyorsa izlenecek durumunu kapat
      }
      $scope.updateDizi(dizi);
    };

    // Dizi güncelle
    $scope.updateDizi = function (dizi) {
      $http
        .put("dizi_takip_api.php", dizi)
        .then(function (response) {
          if (response.data.success) {
            $scope.updateStats();
            $scope.updateFilteredDizis();
          } else {
            showMessage(
              response.data.message || "Dizi güncellenirken hata oluştu",
              "error"
            );
          }
        })
        .catch(function (error) {
          console.error("Dizi güncellenirken hata:", error);
          showMessage("Dizi güncellenirken hata oluştu", "error");
        });
    };

    // İlerleme yüzdesini hesapla
    $scope.getProgressPercentage = function (dizi) {
      if (!dizi.episode_count || dizi.episode_count === 0) return 0;

      const totalEpisodes = dizi.episode_count;
      const watchedEpisodes =
        (dizi.current_season - 1) *
          Math.floor(totalEpisodes / dizi.season_count) +
        dizi.current_episode;

      return Math.min(Math.round((watchedEpisodes / totalEpisodes) * 100), 100);
    };

    // Dizi detayını aç
    $scope.openDiziDetail = function (dizi) {
      // Dizi detay sayfasına yönlendir
      if (dizi.dizi_id) {
        window.location.href = "dizi-detay.html?id=" + dizi.dizi_id;
      } else {
        // Eğer dizi_id yoksa dizi adına göre arama yap
        window.location.href =
          "dizi-detay.html?title=" + encodeURIComponent(dizi.title);
      }
    };

    // Mesaj gösterme fonksiyonu
    function showMessage(message, type) {
      const messageDiv = document.createElement("div");
      messageDiv.className = `message ${type}`;
      messageDiv.textContent = message;
      messageDiv.style.cssText = `
      position: fixed;
      top: 20px;
      right: 20px;
      padding: 15px 25px;
      border-radius: 8px;
      color: white;
      font-weight: 600;
      z-index: 10001;
      animation: slideIn 0.3s ease;
    `;

      if (type === "success") {
        messageDiv.style.background = "#51cf66";
      } else if (type === "error") {
        messageDiv.style.background = "#ff6b6b";
      } else if (type === "warning") {
        messageDiv.style.background = "#ffd43b";
        messageDiv.style.color = "#333";
      }

      document.body.appendChild(messageDiv);

      setTimeout(() => {
        messageDiv.remove();
      }, 3000);
    }

    // Sayfa yüklendiğinde dizileri yükle
    $scope.loadDizis();
  });

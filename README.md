
# ATGCASE

Bu Proje ATG Turkey Şirketi tarafından bana case çalışması olarak gönderilmiştir. Bu bağlamda geliştirilmiştir.

Eksikler ve hatalar için issue açabilir, benimle bu projeyi geliştirmemde yardımcı olabilirsiniz.


## Kullanılan Teknolojiler



 PHP(8.2.4), SYMFONY, DOCKER, POSTGRESQL, CADDY SERVER

   
## Rozetler

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)

[![GPLv3 License](https://img.shields.io/badge/php-8.2.4-blue)](https://opensource.org/licenses/)

[![AGPL License](https://img.shields.io/badge/symfony-6.2.7-red)](http://www.gnu.org/licenses/agpl-3.0)

## Kurulum & Dağıtım

Öncelikle local bilgisayarınıza projeyi clone edin.

```bash
  git clone https://github.com/brylmaz/atgcase.git

```
Bilgisayarınızda Docker Desktop yüklü olmalıdır. atgcase dosyasının içerisine girdikten sonra kök dizinde bulunan docker-compose.yml  dosyası bulunmaktadır. 

Komut satırı açın ve aşağıdaki kodu yazın

```bash
  docker compose up 

```
### NOT
Terminalde aşağıdaki kodu görene kadar bitmesini bekleyin.
```
atgcase-php-1       | - -  03/Apr/2023:13:12:56 +0000 "GET /ping" 200
```


Proje ayağa kalktıktan sonra sırasıyla aşağıdaki kodları docker da çalışan main container cli (atgcase-php-1 container terminali) ne yazın.

```bash
  php bin/console doctrine:migrations:diff  // Bu komut, mevcut veritabanı şemasını ve varsa model sınıflarını karşılaştırarak bir veritabanı migrations dosyası oluşturur.
  
  php bin/console doctrine:migrations:migrate    // Bu komut, migrations dosyasındaki değişiklikleri veritabanına uygular ve tabloyu oluşturur.
  
  php bin/console doctrine:fixtures:load   // Bu komut varsayılan olarak tüm fixture dosyalarını yükler ve mevcut verileri siler.
  
```

Projemiz hazır !

## API Kullanımı

### Arama işlemi (SearchAirport)

Burada veritabanında bulunan verileri field alanına göre sorgulayıp getirebilirsiniz.

#### Endpoint
```http
  POST https://localhost/api/v1/search
```

| Parametre | Tip     | Açıklama                |
| :-------- | :------- | :------------------------- |
| `type` | `string` | **Gerekli**. **Sadece(id,name,country,shortcode,city)**.field alanı |
| `searchString` | `string` | **Gerekli**. Arama yapılacak kelime. |

#### Request Example

```http
{
   "type" : "id",
   "searchString" : "100"
}
```

#### Response Example

  
```http
[
    {
        "id": 100,
        "shortcode": "AEH",
        "name": "Abéché Airport",
        "city": "Abéché",
        "country": "Chad",
        "location": "Abéché, Chad"
    }
]
```

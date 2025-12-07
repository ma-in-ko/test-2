# もぎたて


## 環境
+ マイグレーション
    * php artisan make:migration create_products_table
    * php artisan make:migration create_seasons_table
    * php artisan make:migration create_product_season_table
    * php artisan migrate

+ シーディング
    * php artisan make:seeder ProductsTableSeeder
    * php artisan make:seeder SeasonsTableSeeder
    * php artisan db:seed


## 使用技術
* larave 8.83.29(lang="ja")

## ER図
*[リンク](ER.svg)


## URL
 *開発環境:http:/localhost/products/
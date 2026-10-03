<?php
// Prices are original catalog prices in whole Japanese yen. All promotional
// Prices are derived here so the storefront, cart, and payment API stay aligned.
$products = [
  'linen-dress' => ['name' => 'リネンブレンド ミディワンピース', 'price' => 7980, 'category' => 'ワンピース', 'image' => 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&w=1200&q=85', 'description' => 'さらりとしたリネン混素材と、自然に広がるシルエットが魅力のミディ丈ワンピース。秋口はカーディガンを重ねた着こなしもおすすめです。', 'details' => ['リネン混の軽やかな布帛素材', 'ウエストをほどよく絞ったシルエット', 'サイドポケット付き'] ],
  'satin-dress' => ['name' => 'サテン キャミソールワンピース', 'price' => 8980, 'category' => 'ワンピース', 'image' => 'https://images.unsplash.com/photo-1566174053879-31528523f8ae?auto=format&fit=crop&w=1200&q=85', 'description' => '上品な光沢と落ち感を楽しめるサテンワンピース。ジャケットやニットを合わせれば、季節をまたいで活躍します。', 'details' => ['なめらかなサテン調素材', 'すっきり見えるバイアス風シルエット', '肩ひも長さ調節可能'] ],
  'tailored-blazer' => ['name' => 'オーバーサイズ テーラードジャケット', 'price' => 12980, 'category' => 'ジャケット・アウター', 'image' => 'https://images.unsplash.com/photo-1591369822096-ffd140ec948f?auto=format&fit=crop&w=1200&q=85', 'description' => 'ほどよくゆとりのあるシルエットで、Tシャツにもワンピースにも合わせやすいテーラードジャケット。', 'details' => ['シングルボタン仕様', '裏地付き', 'フロントポケット付き'] ],
  'soft-cardigan' => ['name' => 'ふんわりミドルゲージカーディガン', 'price' => 6980, 'category' => 'ニット・セーター', 'image' => 'https://images.unsplash.com/photo-1581044777550-4cfa60707c03?auto=format&fit=crop&w=1200&q=85', 'description' => 'やわらかな肌触りのミドルゲージニット。羽織りとしても、ボタンを留めてトップスとしても着回せます。', 'details' => ['やわらかなミドルゲージ編み', 'フロントボタン仕様', 'リラックスフィット'] ],
  'wide-leg-trouser' => ['name' => 'タック入り ワイドパンツ', 'price' => 7980, 'category' => 'パンツ', 'image' => 'https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?auto=format&fit=crop&w=1200&q=85', 'description' => 'きれいな落ち感と動きやすさを備えたワイドパンツ。オンにもオフにも取り入れやすい一本です。', 'details' => ['ハイウエストデザイン', 'フロントタック入り', 'ワイドシルエット'] ],
  'leather-tote' => ['name' => 'デイリー ショルダートートバッグ', 'price' => 8980, 'category' => 'バッグ・アクセサリー', 'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?auto=format&fit=crop&w=1200&q=85', 'description' => '毎日の必需品をすっきり収納できる、シンプルなデザインのトートバッグ。', 'details' => ['デイリーに使いやすい収納力', '内側ファスナーポケット付き', 'マグネット開閉'] ],
  'classic-straight-jeans' => ['name' => 'ストレート デニムパンツ', 'price' => 7980, 'category' => 'デニム・ジーンズ', 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?auto=format&fit=crop&w=1200&q=85', 'description' => 'すっきりとしたストレートラインのデニム。ほどよい伸縮性で、デイリーコーデに取り入れやすいアイテムです。', 'details' => ['ほどよいストレッチデニム', 'ハイライズ仕様', 'フルレングス'] ],
  'everyday-active-set' => ['name' => 'リラックス スウェットセットアップ', 'price' => 8980, 'category' => 'セットアップ', 'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=1200&q=85', 'description' => '着心地のよいトップスとボトムスのセット。ワンマイルウェアや移動日のコーデにもおすすめです。', 'details' => ['伸縮性のあるやわらかな素材', '上下セット', '単品でも着回し可能'] ],
  'tailored-capri-pants' => ['name' => 'きれいめ クロップドパンツ', 'price' => 6980, 'category' => 'パンツ', 'image' => 'https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?auto=format&fit=crop&w=1200&q=85', 'description' => '軽やかな丈感とすっきりしたテーパードラインが特徴のクロップドパンツ。', 'details' => ['軽やかな布帛素材', 'クロップド丈', 'サイドファスナー'] ],
  'low-rise-mini-skirt' => ['name' => '台形 ミニスカート', 'price' => 5980, 'category' => 'スカート', 'image' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?auto=format&fit=crop&w=1200&q=85', 'description' => 'コンパクトな台形シルエットのミニスカート。ニットやオーバーサイズシャツとのコーディネートに。', 'details' => ['ほどよいハリ感のツイル素材', 'すっきりとしたウエストまわり', '裏地付き'] ],
  'babydoll-midi-dress' => ['name' => 'ギャザー ミディワンピース', 'price' => 7980, 'category' => 'ワンピース', 'image' => 'https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?auto=format&fit=crop&w=1200&q=85', 'description' => 'ふんわりとしたギャザーと軽やかなコットン素材が魅力。カーディガンを重ねて秋の装いにも。', 'details' => ['コットンポプリン調素材', '切り替えギャザー入り', '肩ひも長さ調節可能'] ],
  'silk-cami-top' => ['name' => 'サテン キャミソールトップス', 'price' => 4980, 'category' => 'レディーストップス', 'image' => 'https://images.unsplash.com/photo-1503342394128-c104d54dba01?auto=format&fit=crop&w=1200&q=85', 'description' => 'なめらかな肌触りと上品なドレープが楽しめるキャミソール。シャツやジャケットのインナーにも便利です。', 'details' => ['上品な光沢のサテン調素材', '肩ひも長さ調節可能', 'ほどよいゆとりのシルエット'] ],
  'oversized-button-shirt' => ['name' => 'コットン オーバーサイズシャツ', 'price' => 6980, 'category' => 'ブラウス・シャツ', 'image' => 'https://images.unsplash.com/photo-1605763240000-7e93b172d754?auto=format&fit=crop&w=1200&q=85', 'description' => '一枚でも羽織りでも活躍する、ゆったりシルエットのコットンシャツ。季節の変わり目のレイヤードにも。', 'details' => ['さらりとしたコットン混素材', 'ゆったりとしたオーバーサイズ', 'ラウンドヘム'] ],
  'lightweight-trench-coat' => ['name' => 'ライト トレンチコート', 'price' => 14980, 'category' => 'ジャケット・アウター', 'image' => 'https://images.unsplash.com/photo-1539533113208-f6df8cc8b543?auto=format&fit=crop&w=1200&q=85', 'description' => '気温差のある季節にさっと羽織れる軽量トレンチ。ウエストベルトでシルエットを調整できます。', 'details' => ['軽量でさらりとした表地', '取り外し可能なウエストベルト', 'フロントポケット付き'] ],
  'cotton-tee' => ['name' => 'ユニセックス オーバーサイズTシャツ', 'price' => 3980, 'category' => 'Tシャツ・カットソー', 'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=1200&q=85', 'description' => '一枚でも重ね着でも使いやすい、ベーシックなコットンTシャツ。ユニセックスのゆったりしたシルエットです。', 'details' => ['肌触りのよいコットン素材', 'ドロップショルダー', 'ユニセックスフィット'] ],
  'mens-shirt' => ['name' => 'メンズ レギュラーカラーシャツ', 'price' => 6980, 'category' => 'メンズシャツ', 'image' => 'https://images.unsplash.com/photo-1603252109303-2751441dd157?auto=format&fit=crop&w=1200&q=85', 'description' => '一枚着にもジャケットのインナーにも合わせやすい、すっきりとしたレギュラーカラーシャツ。', 'details' => ['さらりとしたコットン混素材', 'レギュラーフィット', '胸ポケット付き'] ],
  'mens-hoodie' => ['name' => 'メンズ 裏毛プルオーバーパーカー', 'price' => 7980, 'category' => 'パーカー・スウェット', 'image' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&w=1200&q=85', 'description' => 'ほどよい厚みの裏毛素材を使用したプルオーバーパーカー。秋のカジュアルスタイルに活躍します。', 'details' => ['やわらかな裏毛素材', 'フロントカンガルーポケット', 'リラックスフィット'] ],
  'mens-jacket' => ['name' => 'メンズ カジュアルブルゾン', 'price' => 11980, 'category' => 'メンズジャケット', 'image' => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?auto=format&fit=crop&w=1200&q=85', 'description' => 'シャツやスウェットの上に重ねやすい、軽い着心地のカジュアルブルゾン。', 'details' => ['軽量アウター素材', 'フロントジップ仕様', 'サイドポケット付き'] ],
  'mens-knit' => ['name' => 'メンズ クルーネックニット', 'price' => 7980, 'category' => 'ニット・セーター', 'image' => 'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?auto=format&fit=crop&w=1200&q=85', 'description' => '秋の重ね着に取り入れやすい、ベーシックなクルーネックニット。シャツとのレイヤードも楽しめます。', 'details' => ['やわらかなニット素材', 'クルーネック', 'レギュラーフィット'] ],
];
$colorSets = [
  'satin-dress' => [['name' => 'ローズ', 'hex' => '#b56c7e'], ['name' => 'シャンパン', 'hex' => '#d7c39f'], ['name' => 'ブラック', 'hex' => '#272326']],
  'leather-tote' => [['name' => 'キャメル', 'hex' => '#9c603f'], ['name' => 'ブラック', 'hex' => '#272326']],
  'classic-straight-jeans' => [['name' => 'ブルー', 'hex' => '#54718d'], ['name' => 'インディゴ', 'hex' => '#27364a']],
  'cotton-tee' => [['name' => 'ホワイト', 'hex' => '#f5f3ef'], ['name' => 'ブラック', 'hex' => '#272326'], ['name' => 'グレー', 'hex' => '#aaa6a6']],
  'mens-hoodie' => [['name' => 'グレー', 'hex' => '#aaa6a6'], ['name' => 'ネイビー', 'hex' => '#28354a'], ['name' => 'ブラック', 'hex' => '#272326']],
  'mens-shirt' => [['name' => 'ホワイト', 'hex' => '#f5f3ef'], ['name' => 'ブルー', 'hex' => '#54718d']],
];
foreach ($products as $slug => $product) {
  $products[$slug]['sale_price'] = (int) round($product['price'] * 0.7);
  $products[$slug]['discount_percent'] = 30;
  $products[$slug]['audience'] = str_starts_with($slug, 'mens-') ? 'mens' : ($slug === 'cotton-tee' ? 'unisex' : 'womens');
  $products[$slug]['colors'] = $colorSets[$slug] ?? [['name' => 'アイボリー', 'hex' => '#eee8dd'], ['name' => 'ブラック', 'hex' => '#272326'], ['name' => 'ローズ', 'hex' => '#b56c7e']];
  $products[$slug]['sizes'] = $slug === 'leather-tote' ? ['フリーサイズ'] : ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
  $products[$slug]['sizeImages'] = [$products[$slug]['sizes'][0] => $product['image']];
}
function yen(int|float $price): string { return '¥' . number_format((float) $price, 0, '.', ','); }
?>

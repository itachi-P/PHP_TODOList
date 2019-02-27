DROP TABLE `paiza_bbs`;

-- テーブルの構造 `paiza_bbs`

CREATE TABLE `paiza_bbs` (
  `id` int(5) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_name` text NOT NULL,
  `content` text NOT NULL,
  `updated_at` datetime NOT NULL
) DEFAULT CHARSET=utf8;

INSERT INTO `paiza_bbs` (`user_name`, `content`, `updated_at`) VALUES
('', '世界の皆さん、こんにちは。', '2019-02-24 03:15:31'),
('愛飢男', 'hogehoge', '2019-02-24 03:55:56'),
('Dio', '貧弱貧弱ゥーーーッッ！！', '2019-02-25 05:25:11'),
('いたち', 'スマホからテスト投稿', '2019-02-26 21:03:34'),
('DIO', '売RYYYYYYY!!!!', '2019-02-27 01:00:20'),
('やもめのジョナサン', 'な、何をするだァーーッッ！', '2019-02-27 01:01:20');
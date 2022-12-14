# xSIG series HP management repo

- JSPP,SACSIS,ACSIのHPは[別レポジトリ](github.com/xsig-ws/history) に移動しました。

- xsig 2017-2022に関しては、

## ディレクトリ構造

```
+ README.md
+ docs +
       + _config.yml
       + 2017
       +   :
       + 2022
       + 2023
       + _posts
       + _layouts
       + _includes
```

## 生成方法
生成はGithub Pagesのデフォルトで動作する[Jekyll](https://jekyllrb.com/)を用いる。
JekyllはRubyで記述された静的Webページ生成系である。
対象となるディレクトリのファイルをスキャンし、必要ならHTMLに変換する。
基本的にWebページはmarkdownのみで記述することができる。

Github PagesはデフォルトでJekyllをサポートしており、指定したディレクトリ
もしくはブランチのツリーを対象にJekyllを実行して生成されたWebサイトを
デプロイしてくれる。この過程はActionsで実行されているので、
Actionsをカスタマイズすることで別のフレームワークを用いる事もできる。
しかしJekyllを使うのが楽そうなのでとりあえず2023年度はJekyllを用いた。

### Actionsによる生成の注意点

基本的に、ファイルを編集してコミット、プッシュすれば自動的にActionsが
動作してサイトが再構成される。この際に、実際には下記のプロセスが実行されている。

- コンテナが確保され
- そこに当該ディレクトリがpullされ
- Jekyllによるビルドが実行され
- 生成されたサイトがデプロイされる

ここで注意するべきことは、変更したファイルがたった一つであっても、
すべてのファイルが2度コピーされる、ということである。Actionsの
無料枠は2000分/月 である。一度のビルドで10分近くかかる場合もあるので、
月に200回しか更新できない。

### ローカルなビルド

Github Pages上のビルドには時間がかかること、回数に制限があることから、
手元でローカルに開発可能な環境を確保する必要がある。このためには
ローカルにJekyllをインストールすれば良い。インストール方法は
[ここ](https://jekyllrb.com/docs/installation/)を参考にして
ほしい。

```bundle exec jekyll serve --source docs```

とすると、`_site`以下にサイトが再構成されると同時にローカルなWebサーバが起動
されるので、localhost:4000で見ることができる。
この状態では、ソースを編集するだけで自動的にリビルドが行われるので、効率的に
編集をすすめる事ができる。

## - 2022
2017年から2022年まではWordPressを用いて生成されたものを
スクレイプしている。docsにwp-contentが存在するのはこのためである。
wp-content以下にテーマ関係が入っているので、削除すると動作しなくなるので要注意。

## 2023
2023年度分は[HUST-WS](https://hust-workshop.github.io/)でも用いられている、
[SinglePaged](https://github.com/t413/SinglePaged)というテーマを用いて
作成している。

このテーマは複数のソース・ファイルに記述した内容を一つの長大なHTMLファイルに
まとめる。ソース・ファイルは`docs/_posts/2023-01-XX-XXXXX.md`に存在する。
`default`というレイアウトを用いている。このレイアウトは指定した年のページのみを
対象に変換を行い、一つのファイルに纏めてくれる。

## 2024年以降

もし2024年以降SinglePagesを使わないという判断をする場合には、
手元でレンダリングして生成した静的なディレクトリツリーでdocs以下を置き換えるとよい。
以降の編集がしにくくなるが、jekyllに依存しないで済む。

引き続きSinglePagesを使うのであれば、
- 2023 のディレクトリツリーを複製して 202xを作り、index.mdのファイル内の
`year: 2023` のラインを編集する。
- `_posts/2022-xxxxx.md`をコピーして`_posts/202x-xxxxx.md`を作り、適当に
内容を編集すれば良い。













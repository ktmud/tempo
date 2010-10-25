快速开始Demo开发的模板
======================

极其适合有新项目的时候。

同一目录下尽量不出现首字母重复的子目录/文件，以方便使用 tab 键自动补全。

a/      放置批处理脚本
build/  压缩好的，可以直接传到 assets 服务器的文件
inc/    php函数和 URL 参数处理
pages/  页面，与 ?page= 有关
src/    CSS和js的源文件目录
template/    公用 php 模板，页头、页尾或者其他需要在各个 pages 通用的区块

pages 目录下的结构为：
<pre>
-pages/
|-page1/snippet1.php
|-page1/snippet2.php
|-page1.php
|-page2/snippet1.php
|-page2/snippet2.php
|-page2.php
<pre>

特殊文件
--------
新增的 URL 参数请统一放在 inc/params.php 里

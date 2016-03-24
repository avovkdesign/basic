=== Basic ===
Contributors: wppuzzle, avovkdesign
Requires at least: WordPress 3.5
Tested up to: WordPress 4.4.2
Version: 1.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: light, two-columns, one-column, left-sidebar, right-sidebar, responsive-layout, custom-background, custom-colors, custom-header, custom-menu, editor-style, featured-images,sticky-post, threaded-comments, translation-ready

== Description ==
Basic is simple responsive WordPress theme. It has custom color option, customized layout (left- or rightbar, full or centered content). Preset share buttons, structured data mark-up, clean, valid and SEO-friendly code.

* Responsive layout (mobile first)
* Customized page layouts (leftbar, rightbar, full and centered content)
* Custom main color
* Custom header and background
* Social share links (custom, Share42 or Yandex)
* The GPL v2.0 or later license. :) Use it to make something cool.

== Installation ==

1. In your admin panel, go to Appearance -> Themes and click the 'Add New' button.
2. Type in basic in the search form and press the 'Enter' key on your keyboard.
3. Click on the 'Activate' button to use your new theme right away.
4. Navigate to Appearance > Theme Options in your admin panel and customize to taste.


== Changelog ==

= 1.1.0 =

* Добавлены следующие экшены для использования в дочерних темах или в плагинах:
 * `basic_before_header`
 * `basic_after_sitelogo`
 * `basic_before_topnav`
 * `basic_after_topnav`
 * `basic_after_header`
 * `basic_before_content`
 * `basic_after_content`
 * `basic_before_footer`
 * `basic_before_footer_menu`
 * `basic_before_footer_copyrights`
 * `basic_after_footer_copyrights`
* Добавлен фильтр `basic_singular_content` (принимает один аргумент $content), для возможности изменения текста статьи, добавления своего кода и пр. в дочерних темах или в плагинах
* Добавлены опции для кода html до и после статьи
* Добавлен вывод описания для первой страницы архива метки и автора
* В микроразметке статьи подключается ссылка на полную картнку (Google требует фото от 600 пикс.)
* Исправлены стили маркеров списка (перекрывались с картинками)
* Исправлена проблема с некорректным отображением стиле произвольного меню
* Исправлена проблема с переводом настроек в дочерних темах
* Исправлена пробблема совместимости с PHP ниже 5.5


= 1.0.4 =

* Кнопка "Читать далее" выравнивается по правой стороне
* В главном меню при выводе страниц по-умолчанию, также выводится ссылка на главную страницу
* Настраиваемый цвет логотипа в шапке
* Исправлены стили в шапке (блок с логотипом теперь на всю ширину)
* Исправлена ошибка с отображением меню в подвале
* Исправлены стили с абсолютным позиционированием в подвале
* Добавлена обратная совсместимость wp_title() для WordPress ниже 4.0


= 1.0.3 =

* Добавлены стили для визуального редактора в админке
* Исправлены конфликты стилей с галереями WordPress
* Мелкие правки, рефакторинг кода

= 1.0.2 =

* Исправлен формат даты в микроразметке
* Ссылка на wp-puzzle.com убрана в noindex, nofollow
* Внесены уточнения в перевод, добавлен перевод новых настроек
* Исправлено предупреждение в пагинации

= 1.0.1 =

* Исправлена микроразметка (с отдельных вариантов для яндекс и google, на один универсальный)
* Исправлен формат вывода комментариев, убрана ссылка на себя в имени автора статьи

= 1.0 =

Релиз



== Copyright ==

Basic WordPress Theme, Copyright 2014-2015 WordPress.org
Basic is distributed under the terms of the GNU GPL

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

Basic Theme bundles the following third-party resources:

HTML5 Shiv v3.7.0, Copyright 2014 Alexander Farkas
Licenses: MIT/GPL2
Source: https://github.com/aFarkas/html5shiv

Share42.com,  Copyright 23.09.2014 Dimox
License: GNU GPL, Version 2 (or later)
Source: http://share42.com
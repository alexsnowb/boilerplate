---
title: Add items to the top bar
parent: How-to
permalink: /howto/add-navbar-items
---

# Add items to the top bar

You can add additional views that will be included in the top bar by editing the `navbar` array in `config/boilerplate/theme.php`. This can be useful to add buttons, notifications, ... 

To do that, just add view path using the "dot" notation, ex: `admin.topbar.left` as you might define in a controller.

As you can see in the config file, you can set them on the left or on the right. Simply place the declarations in the appropriate array.

If you have data to be bound to a view that will be include to the top bar, you can use [Laravel View Composers](https://laravel.com/docs/views#view-composers), you can also use `@push('js')` to add js scripts to get the data via ajax calls.
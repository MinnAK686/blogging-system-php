<?php

// Client Side
Route::get("", [PagesController::class, "home"]);
Route::get("about", [PagesController::class, "about"]);
Route::get("blog-detail", [PagesController::class, "blogDetail"]);

// Admin Side
Route::get("admin", [AdminPagesController::class, "home"]);
Route::get("admin/table-view", [AdminPagesController::class, "tableView"]);
Route::post("admin/table-view", [AdminPagesController::class, "tableView"]);
Route::get("admin/delete/post", [AdminPagesController::class, "deletePost"]);


Route::get("admin/login", [AdminPagesController::class, "login"]);
Route::post("admin/login", [AdminPagesController::class, "login"]);

// POST Requests
Route::get("server", [RequestController::class, "server"]);
Route::post("server/add-data", [RequestController::class, "addData"]);

// Loggout
Route::get("logout", [RequestController::class, "logoutAdmin"]);
// Route::post("logout", [RequestController::class, "logoutAdmin"]);

<?php

Route::get("", SiteController::class, "index");
Route::post("research", SiteController::class, "doResearch");
Route::post("filter", SiteController::class, "filter");
Route::post("confirmMail", SiteController::class, "confirmMail");
Route::post("reSendMail", SiteController::class, "reSendMail");


Route::get("animes",AnimeController::class,"allAnime");
Route::get("anime",AnimeController::class,"oneAnime");


Route::get("login",UserController::class,"login");
Route::post("tryLogin",UserController::class,"tryLogin");
Route::get("logout",UserController::class,"logout");
Route::get("sign",UserController::class,'sign');
Route::get("trySign",UserController::class,'trySign');
Route::get("tryConfirm",UserController::class,'tryConfirm');

Route::get("add",ListeAnimeController::class,"add");
Route::get("myList",ListeAnimeController::class,"myList");

Route::get("launch",EtatAnimeController::class,"launch");
Route::get("pause",EtatAnimeController::class,"pause");
Route::get("replay",EtatAnimeController::class,"replay");
Route::get("end",EtatAnimeController::class,"end");
Route::post("newNote",EtatAnimeController::class,"newNote");
Route::post("remove",EtatAnimeController::class,"remove");

Route::get("askAddAnime",DemandeAjoutController::class,"askAddAnime");
Route::get("firstTryAdd",DemandeAjoutController::class,"findCopicat");
Route::get("complementForm",DemandeAjoutController::class,"showComplementForm");
Route::get("tryFinalForm",DemandeAjoutController::class,"tryFinalForm");

Route::post('updateNote',NoteController::class,"updateNote");



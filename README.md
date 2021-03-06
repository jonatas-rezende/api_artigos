# API de Artigos
## Rotas para consumo da API

## Autores
###### Lista de autores
Route::get('/authors', [AuthorController::class, 'index']);
###### Incluir autor no BD
Route::post('/authors', [AuthorController::class, 'store']);
###### Listar autor por id
Route::get('/authors/{id}', [AuthorController::class, 'show']);
###### Atualizar dados do autor
Route::put('/authors/{id}', [AuthorController::class, 'update']);
###### Remover autor
Route::delete('/authors/{id}', [AuthorController::class, 'destroy']);

## Artigos
###### Lista de artigos
Route::get('/articles', [ArticleController::class, 'index']);
###### Incluir artigo no BD
Route::post('/articles', [ArticleController::class, 'store']);
###### Listar artigo por id
Route::get('/articles/{id}', [ArticleController::class, 'show']);
###### Atualizar dados do artigo
Route::put('/articles/{id}', [ArticleController::class, 'update']);
###### Remover artigo
Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);
###### Listar todos os artigos do autor
Route::get('/articles/author/{authorId}', [ArticleController::class, 'showArticlesByAuthorId']);

## Comentários
###### Lista de comentários
Route::get('/comments', [CommentController::class, 'index']);
###### Incluir commentário no BD
Route::post('/comments', [CommentController::class, 'store']);
###### Listar comentário por id
Route::get('/comments/{id}', [CommentController::class, 'show']);
###### Atualizar dados do comentário
Route::put('/comments/{id}', [CommentController::class, 'update']);
###### Remover comentário
Route::delete('/comments/{id}', [CommentController::class, 'destroy']);
###### Listar todos os comentários do artigo
Route::get('/comments/article/{articleId}', [CommentController::class, 'showCommentsByArticleId']);

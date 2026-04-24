# API RESTful de Productos y Categorias (Laravel)

Este proyecto expone una API REST para administrar categorias y productos.

## Base URL

Para pruebas locales con `php artisan serve`:

`http://127.0.0.1:8000/api`

## Headers recomendados en Postman

- `Accept: application/json`
- `Content-Type: application/json`

## CRUD de categorias

### 1) Crear categoria

- Metodo: `POST`
- URL: `/categories`
- Body JSON:

```json
{
  "name": "Perifericos",
  "description": "Teclados, mouse y accesorios"
}
```

- Respuesta esperada (`201 Created`):

```json
{
  "data": {
    "id": 1,
    "name": "Perifericos",
    "description": "Teclados, mouse y accesorios",
    "products_count": 0,
    "created_at": "2026-04-22T12:00:00.000000Z",
    "updated_at": "2026-04-22T12:00:00.000000Z"
  }
}
```

### 2) Listar categorias

- Metodo: `GET`
- URL: `/categories`
- Respuesta esperada (`200 OK`): JSON paginado con `data`, `links` y `meta`.

### 3) Consultar categoria por id

- Metodo: `GET`
- URL: `/categories/{id}`
- Respuesta esperada (`200 OK`):

```json
{
  "data": {
    "id": 1,
    "name": "Perifericos",
    "description": "Teclados, mouse y accesorios",
    "products_count": 0,
    "created_at": "2026-04-22T12:00:00.000000Z",
    "updated_at": "2026-04-22T12:00:00.000000Z"
  }
}
```

### 4) Actualizar categoria

- Metodo: `PUT`
- URL: `/categories/{id}`
- Body JSON:

```json
{
  "name": "Perifericos Gamer",
  "description": "Accesorios para gaming"
}
```

- Respuesta esperada (`200 OK`): JSON con categoria actualizada.

### 5) Eliminar categoria

- Metodo: `DELETE`
- URL: `/categories/{id}`
- Respuesta esperada (`200 OK`):

```json
{
  "message": "Category deleted successfully."
}
```

## CRUD de productos

### 1) Crear producto

- Metodo: `POST`
- URL: `/products`
- Body JSON:

```json
{
  "name": "Teclado Mecanico",
  "description": "Switches blue",
  "descriptionLong": "Teclado mecanico RGB con switches blue y marco de aluminio.",
  "price": 79.9,
  "category_id": 1
}
```

- Respuesta esperada (`201 Created`): JSON con `data` del producto y su `category`.

### 2) Listar productos

- Metodo: `GET`
- URL: `/products`
- Respuesta esperada (`200 OK`): JSON paginado con `data`, `links` y `meta`.

### 3) Consultar producto por id

- Metodo: `GET`
- URL: `/products/{id}`
- Respuesta esperada (`200 OK`): JSON con producto y categoria.

### 4) Actualizar producto

- Metodo: `PUT`
- URL: `/products/{id}`
- Body JSON:

```json
{
  "name": "Teclado Mecanico Pro",
  "description": "Switches red",
  "descriptionLong": "Teclado TKL, RGB y switches red para e-sports.",
  "price": 99.99,
  "category_id": 1
}
```

- Respuesta esperada (`200 OK`): JSON con producto actualizado.

### 5) Eliminar producto

- Metodo: `DELETE`
- URL: `/products/{id}`
- Respuesta esperada (`200 OK`):

```json
{
  "message": "Product deleted successfully."
}
```

## Coleccion Postman

Se incluye una coleccion lista para importar en:

- `postman/brayan23-api.postman_collection.json`

Variables incluidas:

- `base_url` (por defecto `http://127.0.0.1:8000`)
- `category_id`
- `product_id`

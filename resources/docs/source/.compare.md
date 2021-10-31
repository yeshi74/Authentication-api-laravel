---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_0c068b4037fb2e47e71bd44bd36e3e2a -->
## Authorize a client to access the user&#039;s account.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/oauth/authorize" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/authorize"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/authorize`


<!-- END_0c068b4037fb2e47e71bd44bd36e3e2a -->

<!-- START_e48cc6a0b45dd21b7076ab2c03908687 -->
## Approve the authorization request.

> Example request:

```bash
curl -X POST \
    "http://localhost/oauth/authorize" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/authorize"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/authorize`


<!-- END_e48cc6a0b45dd21b7076ab2c03908687 -->

<!-- START_de5d7581ef1275fce2a229b6b6eaad9c -->
## Deny the authorization request.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/oauth/authorize" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/authorize"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/authorize`


<!-- END_de5d7581ef1275fce2a229b6b6eaad9c -->

<!-- START_a09d20357336aa979ecd8e3972ac9168 -->
## Authorize a client to access the user&#039;s account.

> Example request:

```bash
curl -X POST \
    "http://localhost/oauth/token" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/token"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/token`


<!-- END_a09d20357336aa979ecd8e3972ac9168 -->

<!-- START_d6a56149547e03307199e39e03e12d1c -->
## Get all of the authorized tokens for the authenticated user.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/oauth/tokens" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/tokens"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/tokens`


<!-- END_d6a56149547e03307199e39e03e12d1c -->

<!-- START_a9a802c25737cca5324125e5f60b72a5 -->
## Delete the given token.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/oauth/tokens/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/tokens/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/tokens/{token_id}`


<!-- END_a9a802c25737cca5324125e5f60b72a5 -->

<!-- START_abe905e69f5d002aa7d26f433676d623 -->
## Get a fresh transient token cookie for the authenticated user.

> Example request:

```bash
curl -X POST \
    "http://localhost/oauth/token/refresh" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/token/refresh"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/token/refresh`


<!-- END_abe905e69f5d002aa7d26f433676d623 -->

<!-- START_babcfe12d87b8708f5985e9d39ba8f2c -->
## Get all of the clients for the authenticated user.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/oauth/clients" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/clients"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/clients`


<!-- END_babcfe12d87b8708f5985e9d39ba8f2c -->

<!-- START_9eabf8d6e4ab449c24c503fcb42fba82 -->
## Store a new client.

> Example request:

```bash
curl -X POST \
    "http://localhost/oauth/clients" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/clients"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/clients`


<!-- END_9eabf8d6e4ab449c24c503fcb42fba82 -->

<!-- START_784aec390a455073fc7464335c1defa1 -->
## Update the given client.

> Example request:

```bash
curl -X PUT \
    "http://localhost/oauth/clients/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/clients/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT oauth/clients/{client_id}`


<!-- END_784aec390a455073fc7464335c1defa1 -->

<!-- START_1f65a511dd86ba0541d7ba13ca57e364 -->
## Delete the given client.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/oauth/clients/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/clients/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/clients/{client_id}`


<!-- END_1f65a511dd86ba0541d7ba13ca57e364 -->

<!-- START_9e281bd3a1eb1d9eb63190c8effb607c -->
## Get all of the available scopes for the application.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/oauth/scopes" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/scopes"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/scopes`


<!-- END_9e281bd3a1eb1d9eb63190c8effb607c -->

<!-- START_9b2a7699ce6214a79e0fd8107f8b1c9e -->
## Get all of the personal access tokens for the authenticated user.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/oauth/personal-access-tokens" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/personal-access-tokens"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/personal-access-tokens`


<!-- END_9b2a7699ce6214a79e0fd8107f8b1c9e -->

<!-- START_a8dd9c0a5583742e671711f9bb3ee406 -->
## Create a new personal access token for the user.

> Example request:

```bash
curl -X POST \
    "http://localhost/oauth/personal-access-tokens" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/personal-access-tokens"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/personal-access-tokens`


<!-- END_a8dd9c0a5583742e671711f9bb3ee406 -->

<!-- START_bae65df80fd9d72a01439241a9ea20d0 -->
## Delete the given token.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/oauth/personal-access-tokens/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/personal-access-tokens/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/personal-access-tokens/{token_id}`


<!-- END_bae65df80fd9d72a01439241a9ea20d0 -->

<!-- START_8c0e48cd8efa861b308fc45872ff0837 -->
## api/v1/login
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/login`


<!-- END_8c0e48cd8efa861b308fc45872ff0837 -->

<!-- START_8ae5d428da27b2b014dc767c2f19a813 -->
## api/v1/register
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/register`


<!-- END_8ae5d428da27b2b014dc767c2f19a813 -->

<!-- START_bb68992ae7fba92afd2321dad0367f19 -->
## api/v1/checkUser
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/checkUser" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/checkUser"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/checkUser`


<!-- END_bb68992ae7fba92afd2321dad0367f19 -->

<!-- START_ca163e5b523066c744a7e2c116688057 -->
## api/v1/getUser
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/getUser" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/getUser"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/getUser`


<!-- END_ca163e5b523066c744a7e2c116688057 -->

<!-- START_71b90409ef6606d490bd0b46f3be069a -->
## api/v1/feedback/list
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/feedback/list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/feedback/list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/feedback/list`


<!-- END_71b90409ef6606d490bd0b46f3be069a -->

<!-- START_37899c247a73ec6cd9c0b5a3f6c9ca25 -->
## api/v1/feedback/create
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/feedback/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/feedback/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/feedback/create`


<!-- END_37899c247a73ec6cd9c0b5a3f6c9ca25 -->

<!-- START_0fb0b2c721f9459cc6030e7785bac18d -->
## api/v1/feedback/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/feedback/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/feedback/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/feedback/view/{id}`


<!-- END_0fb0b2c721f9459cc6030e7785bac18d -->

<!-- START_98561f5f2ab1e1da96eae5195cd11542 -->
## api/v1/newsletters/list
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/newsletters/list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/newsletters/list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/newsletters/list`


<!-- END_98561f5f2ab1e1da96eae5195cd11542 -->

<!-- START_6c083ffe322a4452d9ac54ce531508ce -->
## api/v1/newsletters/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/newsletters/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/newsletters/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/newsletters/view/{id}`


<!-- END_6c083ffe322a4452d9ac54ce531508ce -->

<!-- START_035413fc4c399ca899bed92597956f07 -->
## api/v1/documents/index
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/documents/index" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/documents/index"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/documents/index`


<!-- END_035413fc4c399ca899bed92597956f07 -->

<!-- START_fa3fc76d6f8a412a36fc29d5cf3c159a -->
## api/v1/documents/list
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/documents/list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/documents/list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/documents/list`


<!-- END_fa3fc76d6f8a412a36fc29d5cf3c159a -->

<!-- START_7492907f9d53c7989770459c50c11785 -->
## api/v1/documents/list/{catid}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/documents/list/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/documents/list/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/documents/list/{catid}`


<!-- END_7492907f9d53c7989770459c50c11785 -->

<!-- START_5b1373672cefa17deb2329f13013be04 -->
## api/v1/documents/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/documents/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/documents/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/documents/view/{id}`


<!-- END_5b1373672cefa17deb2329f13013be04 -->

<!-- START_62ccd5bb009b58bfcceb57a6eac1a0a4 -->
## api/v1/training/list
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/training/list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/training/list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/training/list`


<!-- END_62ccd5bb009b58bfcceb57a6eac1a0a4 -->

<!-- START_fba1b4a369e71bc3d4f9e34c0ab6145c -->
## api/v1/training/list/{catid}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/training/list/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/training/list/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/training/list/{catid}`


<!-- END_fba1b4a369e71bc3d4f9e34c0ab6145c -->

<!-- START_280ba0c2fba9fb9a080f855d3dd6fef8 -->
## api/v1/training/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/training/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/training/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/training/view/{id}`


<!-- END_280ba0c2fba9fb9a080f855d3dd6fef8 -->

<!-- START_e2dac3dbcf72a039bcdbbaed97e91d95 -->
## api/v1/training/update
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/training/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/training/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/training/update`


<!-- END_e2dac3dbcf72a039bcdbbaed97e91d95 -->

<!-- START_8bc6d7cfb511ea71b3ef383540bdb629 -->
## api/v1/blogs/list
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/blogs/list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/blogs/list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/blogs/list`


<!-- END_8bc6d7cfb511ea71b3ef383540bdb629 -->

<!-- START_9c583ae161c7a1e3b660ebbb21b24f3a -->
## api/v1/blogs/list/{catid}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/blogs/list/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/blogs/list/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/blogs/list/{catid}`


<!-- END_9c583ae161c7a1e3b660ebbb21b24f3a -->

<!-- START_55517f634e97ce5cc0d40e13cbe3cb06 -->
## api/v1/blogs/create
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/blogs/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/blogs/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/blogs/create`


<!-- END_55517f634e97ce5cc0d40e13cbe3cb06 -->

<!-- START_f5f27276c0ae0d81e89188c670828887 -->
## api/v1/blogs/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/blogs/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/blogs/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/blogs/view/{id}`


<!-- END_f5f27276c0ae0d81e89188c670828887 -->

<!-- START_6353b5ed486ab67d3e64eda14494c7ac -->
## api/v1/blogs/attach
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/blogs/attach" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/blogs/attach"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/blogs/attach`


<!-- END_6353b5ed486ab67d3e64eda14494c7ac -->

<!-- START_c44e12f17591c5a10675249d783b2706 -->
## api/v1/blogs/add
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/blogs/add" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/blogs/add"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/blogs/add`


<!-- END_c44e12f17591c5a10675249d783b2706 -->

<!-- START_bef36322b1d1377900a4f28ddf810aa9 -->
## api/v1/faq/list
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/faq/list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/faq/list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/faq/list`


<!-- END_bef36322b1d1377900a4f28ddf810aa9 -->

<!-- START_3e3137daa13db6a08e8c00aaecb545ee -->
## api/v1/faq/list/{catid}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/faq/list/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/faq/list/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/faq/list/{catid}`


<!-- END_3e3137daa13db6a08e8c00aaecb545ee -->

<!-- START_2cd84fd81758de3ae26c8ce7809b497a -->
## api/v1/faq/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/faq/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/faq/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/faq/view/{id}`


<!-- END_2cd84fd81758de3ae26c8ce7809b497a -->

<!-- START_11bf6878028531ab18e37e81e229b076 -->
## api/v1/events/list
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/events/list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/events/list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/events/list`


<!-- END_11bf6878028531ab18e37e81e229b076 -->

<!-- START_0fc401a1432fbe3e08ea6b3bb1c95989 -->
## api/v1/events/list/{catid}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/events/list/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/events/list/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/events/list/{catid}`


<!-- END_0fc401a1432fbe3e08ea6b3bb1c95989 -->

<!-- START_b0dc832477e84d4b330c82ffa781e760 -->
## api/v1/events/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/events/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/events/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/events/view/{id}`


<!-- END_b0dc832477e84d4b330c82ffa781e760 -->

<!-- START_4d7305890be067820cb9666da0f15a1e -->
## api/v1/events/update
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/events/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/events/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/events/update`


<!-- END_4d7305890be067820cb9666da0f15a1e -->

<!-- START_0d8c998f7b4df15f3c64f934ff9532a8 -->
## api/v1/albums/list
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/albums/list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/albums/list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/albums/list`


<!-- END_0d8c998f7b4df15f3c64f934ff9532a8 -->

<!-- START_6276e5780e5433fe8196bbb4e6aea252 -->
## api/v1/albums/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/albums/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/albums/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/albums/view/{id}`


<!-- END_6276e5780e5433fe8196bbb4e6aea252 -->

<!-- START_ffc82da1b52803a910ec8e854e780543 -->
## api/v1/albums/view-new/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/albums/view-new/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/albums/view-new/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/albums/view-new/{id}`


<!-- END_ffc82da1b52803a910ec8e854e780543 -->

<!-- START_56b4a7e336f712d76f084b6b8d0ef848 -->
## api/v1/albums/create
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/albums/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/albums/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/albums/create`


<!-- END_56b4a7e336f712d76f084b6b8d0ef848 -->

<!-- START_34cbfccf2a37989c3578aeb5f66fc9e8 -->
## api/v1/albums/createGallery/{id}
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/albums/createGallery/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/albums/createGallery/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/albums/createGallery/{id}`


<!-- END_34cbfccf2a37989c3578aeb5f66fc9e8 -->

<!-- START_1fd64bd9c9933d85b0edee670fbe3a7b -->
## api/v1/contacts/list
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/contacts/list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/contacts/list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/contacts/list`


<!-- END_1fd64bd9c9933d85b0edee670fbe3a7b -->

<!-- START_e80bbc7d78d73ada99c92f895edc945e -->
## api/v1/contacts/list/{buid}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/contacts/list/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/contacts/list/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/contacts/list/{buid}`


<!-- END_e80bbc7d78d73ada99c92f895edc945e -->

<!-- START_4b0967e311ee22069092989a4f76b8b8 -->
## api/v1/contacts/list/{buid}/{regid}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/contacts/list/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/contacts/list/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/contacts/list/{buid}/{regid}`


<!-- END_4b0967e311ee22069092989a4f76b8b8 -->

<!-- START_fb2f3a88f4755baea6610781b76a2ce7 -->
## api/v1/contacts/list/{buid}/{regid}/{centerid}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/contacts/list/1/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/contacts/list/1/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/contacts/list/{buid}/{regid}/{centerid}`


<!-- END_fb2f3a88f4755baea6610781b76a2ce7 -->

<!-- START_1f97920f64c0c1f697df3f6cc0d55c8d -->
## api/v1/contacts/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/contacts/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/contacts/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/contacts/view/{id}`


<!-- END_1f97920f64c0c1f697df3f6cc0d55c8d -->

<!-- START_e5397b28f73cf383085e2de16190a84c -->
## api/v1/contacts/search
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/contacts/search" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/contacts/search"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/contacts/search`


<!-- END_e5397b28f73cf383085e2de16190a84c -->

<!-- START_922d84b311b549a116da41cdb8e850a6 -->
## api/v1/adminusers/list
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/adminusers/list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/adminusers/list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/adminusers/list`


<!-- END_922d84b311b549a116da41cdb8e850a6 -->

<!-- START_25f33a2782ff5fe050a9460397a7e0f7 -->
## api/v1/adminusers/update
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/adminusers/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/adminusers/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/adminusers/update`


<!-- END_25f33a2782ff5fe050a9460397a7e0f7 -->

<!-- START_3c3f8f569edaec795e44929f7a10c970 -->
## api/v1/adminusers/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/adminusers/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/adminusers/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/adminusers/view/{id}`


<!-- END_3c3f8f569edaec795e44929f7a10c970 -->

<!-- START_ea6099a63a075032fd50623fcdb599f4 -->
## api/v1/adminusers/getProfile
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/adminusers/getProfile" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/adminusers/getProfile"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/adminusers/getProfile`


<!-- END_ea6099a63a075032fd50623fcdb599f4 -->

<!-- START_b47a2ee0926b5bdda63bbe98a4da09dd -->
## api/v1/adminusers/updateProfile
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/adminusers/updateProfile" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/adminusers/updateProfile"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/adminusers/updateProfile`


<!-- END_b47a2ee0926b5bdda63bbe98a4da09dd -->

<!-- START_574e934fa8bd59d4c253c28bea655ac4 -->
## api/v1/resetPassword
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/resetPassword" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/resetPassword"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/resetPassword`


<!-- END_574e934fa8bd59d4c253c28bea655ac4 -->

<!-- START_b6d866f5c7fc0e28e4ed9be4e33ed51c -->
## api/v1/category/getCategory/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/category/getCategory/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/category/getCategory/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/category/getCategory/{id}`


<!-- END_b6d866f5c7fc0e28e4ed9be4e33ed51c -->

<!-- START_3ed36c625a6e1d71db5ca370001d326f -->
## api/v1/department/list
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/department/list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/department/list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/department/list`


<!-- END_3ed36c625a6e1d71db5ca370001d326f -->

<!-- START_95c30bbd1e50ab6bb563fcc879cdd46f -->
## api/v1/locations/getLocations/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/locations/getLocations/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/locations/getLocations/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/locations/getLocations/{id}`


<!-- END_95c30bbd1e50ab6bb563fcc879cdd46f -->

<!-- START_2000fdd90a7f29bb54c954510fef4f6c -->
## api/v1/locations/getLocations/{typ}/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/locations/getLocations/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/locations/getLocations/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/locations/getLocations/{typ}/{id}`


<!-- END_2000fdd90a7f29bb54c954510fef4f6c -->

<!-- START_f739581495d6cd4bad1bb506eb8e65f3 -->
## api/v1/locations/getBUCenters/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/locations/getBUCenters/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/locations/getBUCenters/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/locations/getBUCenters/{id}`


<!-- END_f739581495d6cd4bad1bb506eb8e65f3 -->

<!-- START_ca364b2c4f4b6808477da83b9d954123 -->
## api/v1/incidents/list
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/incidents/list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/incidents/list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/incidents/list`


<!-- END_ca364b2c4f4b6808477da83b9d954123 -->

<!-- START_9732569ff9aeab3c55e4be06db221c69 -->
## api/v1/incidents/details/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/incidents/details/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/incidents/details/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/incidents/details/{id}`


<!-- END_9732569ff9aeab3c55e4be06db221c69 -->

<!-- START_f9cb50abc3bb8d9ba7ab07390c62611b -->
## api/v1/incidents/save
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/incidents/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/incidents/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/incidents/save`


<!-- END_f9cb50abc3bb8d9ba7ab07390c62611b -->

<!-- START_5bbe5f65f43f457441da2570e557f6bb -->
## api/v1/incidents/test
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/incidents/test" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/incidents/test"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/incidents/test`


<!-- END_5bbe5f65f43f457441da2570e557f6bb -->

<!-- START_654c1903a77dbe0f70036b4b7b5bc4d9 -->
## api/v1/incidents/category
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/incidents/category" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/incidents/category"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/incidents/category`


<!-- END_654c1903a77dbe0f70036b4b7b5bc4d9 -->

<!-- START_ce3d8d47eda022b9b00beff02f8412e3 -->
## api/v1/incidents/update
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/incidents/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/incidents/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/incidents/update`


<!-- END_ce3d8d47eda022b9b00beff02f8412e3 -->

<!-- START_7bbc8bc2d5f3571e65b16230c91c1806 -->
## api/v1/notifications
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/notifications" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/notifications"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/notifications`


<!-- END_7bbc8bc2d5f3571e65b16230c91c1806 -->

<!-- START_e825fff6def47a38a6f8e2fe41de9651 -->
## api/v1/tasks
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/tasks" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/tasks"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/tasks`


<!-- END_e825fff6def47a38a6f8e2fe41de9651 -->

<!-- START_84ea95345c4dda0afa440f31b0cf6c4e -->
## api/v1/tasks/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/tasks/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/tasks/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/tasks/view/{id}`


<!-- END_84ea95345c4dda0afa440f31b0cf6c4e -->

<!-- START_fce154f5e60c4044f63421da25641eb4 -->
## api/v1/q4e/list
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/q4e/list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/q4e/list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/q4e/list`


<!-- END_fce154f5e60c4044f63421da25641eb4 -->

<!-- START_05d5c63474410fc084fd461cb6bc9945 -->
## api/v1/q4e/list/{code}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/q4e/list/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/q4e/list/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/q4e/list/{code}`


<!-- END_05d5c63474410fc084fd461cb6bc9945 -->

<!-- START_39d6ded0eeea2b0a321c1bb0ab25c061 -->
## api/v1/q4e/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/q4e/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/q4e/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/q4e/view/{id}`


<!-- END_39d6ded0eeea2b0a321c1bb0ab25c061 -->

<!-- START_42a9e5f5e18eb499d51a9b9e4d3994e4 -->
## api/v1/q4e/save-continue
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/q4e/save-continue" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/q4e/save-continue"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/q4e/save-continue`


<!-- END_42a9e5f5e18eb499d51a9b9e4d3994e4 -->

<!-- START_1e14825126c6bb590cdb40e588256071 -->
## api/v1/q4e/save-complete
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/q4e/save-complete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/q4e/save-complete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/q4e/save-complete`


<!-- END_1e14825126c6bb590cdb40e588256071 -->

<!-- START_66e08d3cc8222573018fed49e121e96d -->
## Show the application&#039;s login form.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET login`


<!-- END_66e08d3cc8222573018fed49e121e96d -->

<!-- START_ba35aa39474cb98cfb31829e70eb8b74 -->
## Handle a login request to the application.

> Example request:

```bash
curl -X POST \
    "http://localhost/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST login`


<!-- END_ba35aa39474cb98cfb31829e70eb8b74 -->

<!-- START_e65925f23b9bc6b93d9356895f29f80c -->
## Log the user out of the application.

> Example request:

```bash
curl -X POST \
    "http://localhost/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST logout`


<!-- END_e65925f23b9bc6b93d9356895f29f80c -->

<!-- START_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->
## Show the application registration form.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET register`


<!-- END_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->

<!-- START_d7aad7b5ac127700500280d511a3db01 -->
## Handle a registration request for the application.

> Example request:

```bash
curl -X POST \
    "http://localhost/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST register`


<!-- END_d7aad7b5ac127700500280d511a3db01 -->

<!-- START_d72797bae6d0b1f3a341ebb1f8900441 -->
## Display the form to request a password reset link.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET password/reset`


<!-- END_d72797bae6d0b1f3a341ebb1f8900441 -->

<!-- START_feb40f06a93c80d742181b6ffb6b734e -->
## Send a reset link to the given user.

> Example request:

```bash
curl -X POST \
    "http://localhost/password/email" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/email"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/email`


<!-- END_feb40f06a93c80d742181b6ffb6b734e -->

<!-- START_e1605a6e5ceee9d1aeb7729216635fd7 -->
## Display the password reset view for the given token.

If no token is present, display the link request form.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/password/reset/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/reset/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET password/reset/{token}`


<!-- END_e1605a6e5ceee9d1aeb7729216635fd7 -->

<!-- START_cafb407b7a846b31491f97719bb15aef -->
## Reset the given user&#039;s password.

> Example request:

```bash
curl -X POST \
    "http://localhost/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/reset`


<!-- END_cafb407b7a846b31491f97719bb15aef -->

<!-- START_03a76d7b7a89853a08696bfe71bbbba7 -->
## admin/login
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET admin/login`


<!-- END_03a76d7b7a89853a08696bfe71bbbba7 -->

<!-- START_2c95a94c5cf668cbd7ef6d9e969680db -->
## admin/authenticate
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/authenticate" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/authenticate"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/authenticate`


<!-- END_2c95a94c5cf668cbd7ef6d9e969680db -->

<!-- START_8a2563db7e870af9b66e4f87d546e3cf -->
## file/img/{ref}/{img}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/file/img/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/file/img/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET file/img/{ref}/{img}`


<!-- END_8a2563db7e870af9b66e4f87d546e3cf -->

<!-- START_a6e993ec8f871dfe3a5e2db54c18b496 -->
## file/view/{ref}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/file/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/file/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET file/view/{ref}`


<!-- END_a6e993ec8f871dfe3a5e2db54c18b496 -->

<!-- START_39a970e82954b64c2aaf04ea253244d0 -->
## admin/file/list/{module}/{id}/{mode}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/file/list/1/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/file/list/1/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET admin/file/list/{module}/{id}/{mode}`


<!-- END_39a970e82954b64c2aaf04ea253244d0 -->

<!-- START_da1f32aad558d6426c83b70efebce834 -->
## admin/no-permission
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/no-permission" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/no-permission"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET admin/no-permission`


<!-- END_da1f32aad558d6426c83b70efebce834 -->

<!-- START_8a59594ff635c00027a130968fc47527 -->
## admin/dashboard
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/dashboard" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/dashboard"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/dashboard`


<!-- END_8a59594ff635c00027a130968fc47527 -->

<!-- START_b37225c1c4a9d4a9e253fecd543b79a0 -->
## admin/logout
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/logout`


<!-- END_b37225c1c4a9d4a9e253fecd543b79a0 -->

<!-- START_b4419d01f964c1f904108144da890c04 -->
## admin/locations
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/locations" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/locations"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/locations`


<!-- END_b4419d01f964c1f904108144da890c04 -->

<!-- START_899b490403a73335c5ccc37b325219d5 -->
## admin/locations/region/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/locations/region/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/locations/region/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/locations/region/{id}`


<!-- END_899b490403a73335c5ccc37b325219d5 -->

<!-- START_9c4d4dc2df971673c3ee41de19dabf6e -->
## admin/locations/center/{id}/{region}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/locations/center/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/locations/center/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/locations/center/{id}/{region}`


<!-- END_9c4d4dc2df971673c3ee41de19dabf6e -->

<!-- START_d7ba3e6a0ea5f07b64e1be1ec2aa050b -->
## admin/locations/add/bu
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/locations/add/bu" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/locations/add/bu"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/locations/add/bu`


<!-- END_d7ba3e6a0ea5f07b64e1be1ec2aa050b -->

<!-- START_94240dd1ff9fa9a2cba12139c7f3b43d -->
## admin/locations/add/region
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/locations/add/region" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/locations/add/region"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/locations/add/region`


<!-- END_94240dd1ff9fa9a2cba12139c7f3b43d -->

<!-- START_4a3e82bd7308402be17721fcc705062d -->
## admin/locations/add/center
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/locations/add/center" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/locations/add/center"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/locations/add/center`


<!-- END_4a3e82bd7308402be17721fcc705062d -->

<!-- START_dc32fa17033c8de742c2ac6829b6b671 -->
## admin/locations/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/locations/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/locations/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/locations/view/{id}`


<!-- END_dc32fa17033c8de742c2ac6829b6b671 -->

<!-- START_5749074ad1f20cf0cbfae7b9b051e0c6 -->
## admin/file/save
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/file/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/file/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/file/save`


<!-- END_5749074ad1f20cf0cbfae7b9b051e0c6 -->

<!-- START_b7693a622c88a08abdd9196be94358f0 -->
## admin/file/delete
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/file/delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/file/delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/file/delete`


<!-- END_b7693a622c88a08abdd9196be94358f0 -->

<!-- START_b02cea64732545a739e6e291617a151d -->
## admin/file/up/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/file/up/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/file/up/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/file/up/{id}`


<!-- END_b02cea64732545a739e6e291617a151d -->

<!-- START_7037e5eff1b933773c9fed59c212754d -->
## admin/file/down/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/file/down/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/file/down/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/file/down/{id}`


<!-- END_7037e5eff1b933773c9fed59c212754d -->

<!-- START_faeb23c28ba76906db395f13aade83a2 -->
## admin/favorites/getFavorites/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/favorites/getFavorites/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/favorites/getFavorites/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/favorites/getFavorites/{id}`


<!-- END_faeb23c28ba76906db395f13aade83a2 -->

<!-- START_f3e8e75babcf306e7ee5fcd6089d50e1 -->
## admin/favorites/addFavorites/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/favorites/addFavorites/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/favorites/addFavorites/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/favorites/addFavorites/{id}`


<!-- END_f3e8e75babcf306e7ee5fcd6089d50e1 -->

<!-- START_7035e7ea18642f6f587a9c88d8ea24d0 -->
## admin/favorites/delFavorites/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/favorites/delFavorites/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/favorites/delFavorites/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/favorites/delFavorites/{id}`


<!-- END_7035e7ea18642f6f587a9c88d8ea24d0 -->

<!-- START_d1862e0611b9cf895c90b5d93d2c5f56 -->
## admin/faq
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/faq" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/faq"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/faq`


<!-- END_d1862e0611b9cf895c90b5d93d2c5f56 -->

<!-- START_4dbe2fddea63b5684ad2f1081d7e1595 -->
## admin/faq/add
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/faq/add" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/faq/add"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/faq/add`


<!-- END_4dbe2fddea63b5684ad2f1081d7e1595 -->

<!-- START_699cf4b728e329f8646b624691642953 -->
## admin/faq/save
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/faq/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/faq/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/faq/save`


<!-- END_699cf4b728e329f8646b624691642953 -->

<!-- START_d650edf8e7b1042118f7241b9773941a -->
## admin/faq/edit/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/faq/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/faq/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/faq/edit/{id}`


<!-- END_d650edf8e7b1042118f7241b9773941a -->

<!-- START_d48313d300231f0a5c1b5196c9d11402 -->
## admin/faq/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/faq/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/faq/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/faq/update`


<!-- END_d48313d300231f0a5c1b5196c9d11402 -->

<!-- START_d7e0469350a74c93ce4c2548315b25d8 -->
## admin/faq/delete
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/faq/delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/faq/delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/faq/delete`


<!-- END_d7e0469350a74c93ce4c2548315b25d8 -->

<!-- START_ec254ac4468bd5b1cfced5ec8bbf7947 -->
## admin/faq/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/faq/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/faq/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/faq/view/{id}`


<!-- END_ec254ac4468bd5b1cfced5ec8bbf7947 -->

<!-- START_d1e9e1b95a199a4980bd4525fd0f38e3 -->
## admin/category
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/category" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/category"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/category`


<!-- END_d1e9e1b95a199a4980bd4525fd0f38e3 -->

<!-- START_4d269f27df4db920c627b2aa1396bc26 -->
## admin/category/list
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/category/list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/category/list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/category/list`


<!-- END_4d269f27df4db920c627b2aa1396bc26 -->

<!-- START_c4f15ca8095b94f416cfa229754ef19d -->
## admin/category/add
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/category/add" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/category/add"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/category/add`


<!-- END_c4f15ca8095b94f416cfa229754ef19d -->

<!-- START_24b54169c2f2f66ef199b65a8fa80c53 -->
## admin/category/save
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/category/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/category/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/category/save`


<!-- END_24b54169c2f2f66ef199b65a8fa80c53 -->

<!-- START_5d291240401adf29b17e06f4971dee78 -->
## admin/category/edit/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/category/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/category/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/category/edit/{id}`


<!-- END_5d291240401adf29b17e06f4971dee78 -->

<!-- START_f76a129fcac3dece4cc5697a4ba85a05 -->
## admin/category/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/category/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/category/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/category/update`


<!-- END_f76a129fcac3dece4cc5697a4ba85a05 -->

<!-- START_88dd4477d936a8da8754382e2001d009 -->
## admin/category/delete
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/category/delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/category/delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/category/delete`


<!-- END_88dd4477d936a8da8754382e2001d009 -->

<!-- START_149d0d578a07d277c6ed10bd3fd47862 -->
## admin/category/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/category/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/category/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/category/view/{id}`


<!-- END_149d0d578a07d277c6ed10bd3fd47862 -->

<!-- START_195ff45537dc94c199adb8afa1541674 -->
## admin/training
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/training" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/training"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/training`


<!-- END_195ff45537dc94c199adb8afa1541674 -->

<!-- START_c512b9f0badd79eb34a177f437527ce9 -->
## admin/training/add
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/training/add" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/training/add"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/training/add`


<!-- END_c512b9f0badd79eb34a177f437527ce9 -->

<!-- START_2d62d354a95f65efb21504f171e03d24 -->
## admin/training/save
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/training/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/training/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/training/save`


<!-- END_2d62d354a95f65efb21504f171e03d24 -->

<!-- START_02cd45cdc6338ce9662dc6528000ee9b -->
## admin/training/edit/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/training/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/training/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/training/edit/{id}`


<!-- END_02cd45cdc6338ce9662dc6528000ee9b -->

<!-- START_b3f2b4e13af2bac62135ad8c9c33646a -->
## admin/training/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/training/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/training/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/training/update`


<!-- END_b3f2b4e13af2bac62135ad8c9c33646a -->

<!-- START_b7b149f2a44b675fde462c582882e820 -->
## admin/training/delete
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/training/delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/training/delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/training/delete`


<!-- END_b7b149f2a44b675fde462c582882e820 -->

<!-- START_d707e748038bed0d22ebf78f7072cea1 -->
## admin/training/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/training/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/training/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/training/view/{id}`


<!-- END_d707e748038bed0d22ebf78f7072cea1 -->

<!-- START_6239925b7a912df847ecd46a10564d3d -->
## admin/training/viewsurvey/{action}/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/training/viewsurvey/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/training/viewsurvey/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/training/viewsurvey/{action}/{id}`


<!-- END_6239925b7a912df847ecd46a10564d3d -->

<!-- START_d613afa6b18f24fc227e9fcaeb5435d0 -->
## admin/feedback
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/feedback" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/feedback"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/feedback`


<!-- END_d613afa6b18f24fc227e9fcaeb5435d0 -->

<!-- START_0e8e0d8e59459090903009226a922aad -->
## admin/feedback/list/{action}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/feedback/list/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/feedback/list/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/feedback/list/{action}`


<!-- END_0e8e0d8e59459090903009226a922aad -->

<!-- START_a509a1c64f74ec108960960af1f22cef -->
## admin/feedback/edit/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/feedback/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/feedback/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/feedback/edit/{id}`


<!-- END_a509a1c64f74ec108960960af1f22cef -->

<!-- START_66e641ee10c8ff31fe98bfe56b93b1b2 -->
## admin/feedback/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/feedback/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/feedback/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/feedback/update`


<!-- END_66e641ee10c8ff31fe98bfe56b93b1b2 -->

<!-- START_4374fa8a19b380f128221ea0ddf8fc50 -->
## admin/feedback/reply
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/feedback/reply" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/feedback/reply"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/feedback/reply`


<!-- END_4374fa8a19b380f128221ea0ddf8fc50 -->

<!-- START_578cc8015ca22818a459028efb57158e -->
## admin/feedback/delete
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/feedback/delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/feedback/delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/feedback/delete`


<!-- END_578cc8015ca22818a459028efb57158e -->

<!-- START_6db0fb15b0b7c949813b0b845d31fd3f -->
## admin/feedback/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/feedback/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/feedback/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/feedback/view/{id}`


<!-- END_6db0fb15b0b7c949813b0b845d31fd3f -->

<!-- START_879622c0ac94a4a0f4d364d46a42bc7e -->
## admin/roles
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/roles" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/roles"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/roles`


<!-- END_879622c0ac94a4a0f4d364d46a42bc7e -->

<!-- START_1fa7561870d179258154e56b80f05ab4 -->
## admin/roles/add
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/roles/add" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/roles/add"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/roles/add`


<!-- END_1fa7561870d179258154e56b80f05ab4 -->

<!-- START_e896cc060cf68994a1b84d123c943a42 -->
## admin/roles/save
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/roles/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/roles/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/roles/save`


<!-- END_e896cc060cf68994a1b84d123c943a42 -->

<!-- START_3950a0644aca5d27e97cc7878cd9e49a -->
## admin/roles/edit/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/roles/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/roles/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/roles/edit/{id}`


<!-- END_3950a0644aca5d27e97cc7878cd9e49a -->

<!-- START_2732e3b041569586a2c00ff9879baae2 -->
## admin/roles/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/roles/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/roles/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/roles/update`


<!-- END_2732e3b041569586a2c00ff9879baae2 -->

<!-- START_737735fd2a13bc963c012c569852f887 -->
## admin/roles/delete
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/roles/delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/roles/delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/roles/delete`


<!-- END_737735fd2a13bc963c012c569852f887 -->

<!-- START_bc6dadfed417daf75537139b4000c8c0 -->
## admin/roles/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/roles/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/roles/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/roles/view/{id}`


<!-- END_bc6dadfed417daf75537139b4000c8c0 -->

<!-- START_80ef819bfdb1eaa1790618e27dc7cd59 -->
## admin/newsletters
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/newsletters" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/newsletters"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/newsletters`


<!-- END_80ef819bfdb1eaa1790618e27dc7cd59 -->

<!-- START_4a6d231bff1f85c5737a62f7ebee23c7 -->
## admin/newsletters/add
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/newsletters/add" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/newsletters/add"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/newsletters/add`


<!-- END_4a6d231bff1f85c5737a62f7ebee23c7 -->

<!-- START_b7d203093dadaf924a661d793627d7bb -->
## admin/newsletters/save
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/newsletters/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/newsletters/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/newsletters/save`


<!-- END_b7d203093dadaf924a661d793627d7bb -->

<!-- START_52626be05161a9a2b46c18e254ebb1cd -->
## admin/newsletters/edit/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/newsletters/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/newsletters/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/newsletters/edit/{id}`


<!-- END_52626be05161a9a2b46c18e254ebb1cd -->

<!-- START_5b4e64ef8c1c2b048e452500c292ce17 -->
## admin/newsletters/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/newsletters/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/newsletters/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/newsletters/update`


<!-- END_5b4e64ef8c1c2b048e452500c292ce17 -->

<!-- START_fb58f2b0cd90e14c094084c1be8052df -->
## admin/newsletters/delete
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/newsletters/delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/newsletters/delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/newsletters/delete`


<!-- END_fb58f2b0cd90e14c094084c1be8052df -->

<!-- START_ccc6bb810b01b7b7950664b23745447a -->
## admin/newsletters/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/newsletters/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/newsletters/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/newsletters/view/{id}`


<!-- END_ccc6bb810b01b7b7950664b23745447a -->

<!-- START_f5628904b4d915650cf14b68e8de3201 -->
## admin/adminusers
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/adminusers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/adminusers"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/adminusers`


<!-- END_f5628904b4d915650cf14b68e8de3201 -->

<!-- START_a30d208f149a816fdacb11c583411f1a -->
## admin/adminusers/addnew
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/adminusers/addnew" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/adminusers/addnew"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/adminusers/addnew`


<!-- END_a30d208f149a816fdacb11c583411f1a -->

<!-- START_c337d3affc0f24462df31e80585b7976 -->
## admin/adminusers/save
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/adminusers/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/adminusers/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/adminusers/save`


<!-- END_c337d3affc0f24462df31e80585b7976 -->

<!-- START_36676eed1bf1af393afbe5c969da2a4e -->
## admin/adminusers/edit/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/adminusers/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/adminusers/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/adminusers/edit/{id}`


<!-- END_36676eed1bf1af393afbe5c969da2a4e -->

<!-- START_fdff769768cfc1fae992641f2c752fa9 -->
## admin/adminusers/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/adminusers/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/adminusers/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/adminusers/update`


<!-- END_fdff769768cfc1fae992641f2c752fa9 -->

<!-- START_1745de465086f4671091d58f22fae604 -->
## admin/adminusers/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/adminusers/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/adminusers/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/adminusers/view/{id}`


<!-- END_1745de465086f4671091d58f22fae604 -->

<!-- START_1be0bb23154ecc61c2d481db6a1b9647 -->
## admin/contacts
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/contacts" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/contacts"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/contacts`


<!-- END_1be0bb23154ecc61c2d481db6a1b9647 -->

<!-- START_3183e58773e059eacfda9570c91693d7 -->
## admin/contacts/add
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/contacts/add" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/contacts/add"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/contacts/add`


<!-- END_3183e58773e059eacfda9570c91693d7 -->

<!-- START_4e7aeeabdd155cc45e59675111e2f451 -->
## admin/contacts/save
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/contacts/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/contacts/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/contacts/save`


<!-- END_4e7aeeabdd155cc45e59675111e2f451 -->

<!-- START_1569a258e9403fc5abf4d041121b332b -->
## admin/contacts/edit/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/contacts/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/contacts/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/contacts/edit/{id}`


<!-- END_1569a258e9403fc5abf4d041121b332b -->

<!-- START_76ac9d54ffa13dedf7cac3d7d51d4431 -->
## admin/contacts/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/contacts/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/contacts/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/contacts/update`


<!-- END_76ac9d54ffa13dedf7cac3d7d51d4431 -->

<!-- START_dc36aeb3649fdf50c62aca8e2bc46492 -->
## admin/contacts/delete
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/contacts/delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/contacts/delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/contacts/delete`


<!-- END_dc36aeb3649fdf50c62aca8e2bc46492 -->

<!-- START_88bdf34eed3edfee4ce21713201e2d99 -->
## admin/contacts/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/contacts/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/contacts/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/contacts/view/{id}`


<!-- END_88bdf34eed3edfee4ce21713201e2d99 -->

<!-- START_713a448482de9ec17cc7c56dc5e6fe59 -->
## admin/documents
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/documents" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/documents"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/documents`


<!-- END_713a448482de9ec17cc7c56dc5e6fe59 -->

<!-- START_01ff08a5b94da6dcde0a2f44b77a7d55 -->
## admin/documents/add
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/documents/add" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/documents/add"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/documents/add`


<!-- END_01ff08a5b94da6dcde0a2f44b77a7d55 -->

<!-- START_d90491770980fc0d60ba5100e63e46bb -->
## admin/documents/save
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/documents/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/documents/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/documents/save`


<!-- END_d90491770980fc0d60ba5100e63e46bb -->

<!-- START_6a56da5764748c31377c5631c6072187 -->
## admin/documents/edit/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/documents/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/documents/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/documents/edit/{id}`


<!-- END_6a56da5764748c31377c5631c6072187 -->

<!-- START_6c7948e252b4bdeca575a0b9dcc7dace -->
## admin/documents/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/documents/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/documents/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/documents/update`


<!-- END_6c7948e252b4bdeca575a0b9dcc7dace -->

<!-- START_49f48ed8dbfb65539699587f18cc61eb -->
## admin/documents/delete
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/documents/delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/documents/delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/documents/delete`


<!-- END_49f48ed8dbfb65539699587f18cc61eb -->

<!-- START_855a31e94a57b09d54281b728bb3bb97 -->
## admin/documents/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/documents/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/documents/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/documents/view/{id}`


<!-- END_855a31e94a57b09d54281b728bb3bb97 -->

<!-- START_d8ad825945c580a9f7799560f23ed715 -->
## admin/incidents
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/incidents" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/incidents"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/incidents`


<!-- END_d8ad825945c580a9f7799560f23ed715 -->

<!-- START_09eb602ecc396be479ad67a124275da3 -->
## admin/incidents/assign
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/incidents/assign" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/incidents/assign"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/incidents/assign`


<!-- END_09eb602ecc396be479ad67a124275da3 -->

<!-- START_0711037c348e1c204ed45ccd5bf2a55b -->
## admin/incidents/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/incidents/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/incidents/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/incidents/view/{id}`


<!-- END_0711037c348e1c204ed45ccd5bf2a55b -->

<!-- START_9d080028efb979668f9255e719082505 -->
## admin/incidents/close
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/incidents/close" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/incidents/close"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/incidents/close`


<!-- END_9d080028efb979668f9255e719082505 -->

<!-- START_7e4452df529a9618b0a087827674fa62 -->
## admin/incidents/edit/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/incidents/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/incidents/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/incidents/edit/{id}`


<!-- END_7e4452df529a9618b0a087827674fa62 -->

<!-- START_bd01185b617f5b51819e1467dc2bbbb8 -->
## admin/incidents/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/incidents/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/incidents/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/incidents/update`


<!-- END_bd01185b617f5b51819e1467dc2bbbb8 -->

<!-- START_316067f6bbbacc850e42847b21d97bae -->
## admin/incidents/filter/{action}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/incidents/filter/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/incidents/filter/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/incidents/filter/{action}`


<!-- END_316067f6bbbacc850e42847b21d97bae -->

<!-- START_6397d27d96d289c0cb756657073d7783 -->
## admin/incidents/assign-update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/incidents/assign-update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/incidents/assign-update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/incidents/assign-update`


<!-- END_6397d27d96d289c0cb756657073d7783 -->

<!-- START_18e8ffee553f1966cc241da3023cc3c7 -->
## admin/incidents/track-view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/incidents/track-view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/incidents/track-view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/incidents/track-view/{id}`


<!-- END_18e8ffee553f1966cc241da3023cc3c7 -->

<!-- START_85900e59936a2963ef230a4a59bedcbb -->
## admin/incidents/add-comments
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/incidents/add-comments" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/incidents/add-comments"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/incidents/add-comments`


<!-- END_85900e59936a2963ef230a4a59bedcbb -->

<!-- START_5646ac043c25dc4dec6121cecc54e3a7 -->
## admin/incidents/search
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/incidents/search" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/incidents/search"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/incidents/search`


<!-- END_5646ac043c25dc4dec6121cecc54e3a7 -->

<!-- START_a09d3e14a057f978d6519ad16577b9ca -->
## admin/incidents/report
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/incidents/report" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/incidents/report"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/incidents/report`


<!-- END_a09d3e14a057f978d6519ad16577b9ca -->

<!-- START_3cdf2a9e0ea91fd4f1c13dcbbc03e455 -->
## admin/albums
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/albums" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/albums"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/albums`


<!-- END_3cdf2a9e0ea91fd4f1c13dcbbc03e455 -->

<!-- START_c683ed4f5b1c883211657bbc9db842ec -->
## admin/albums/for-approval
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/albums/for-approval" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/albums/for-approval"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/albums/for-approval`


<!-- END_c683ed4f5b1c883211657bbc9db842ec -->

<!-- START_830cef47c79d7ac3ee08cdb227393d01 -->
## admin/albums/add
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/albums/add" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/albums/add"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/albums/add`


<!-- END_830cef47c79d7ac3ee08cdb227393d01 -->

<!-- START_cbbf128ef816263976a942e3ca98e881 -->
## admin/albums/save
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/albums/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/albums/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/albums/save`


<!-- END_cbbf128ef816263976a942e3ca98e881 -->

<!-- START_9452ca4511ff9e98d7b8f235f63851e3 -->
## admin/albums/edit/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/albums/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/albums/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/albums/edit/{id}`


<!-- END_9452ca4511ff9e98d7b8f235f63851e3 -->

<!-- START_90587b9c5faed7de267ac82f63e6bb00 -->
## admin/albums/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/albums/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/albums/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/albums/update`


<!-- END_90587b9c5faed7de267ac82f63e6bb00 -->

<!-- START_ffc92fcf85db0548ecb634d082fd0c23 -->
## admin/albums/delete
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/albums/delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/albums/delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/albums/delete`


<!-- END_ffc92fcf85db0548ecb634d082fd0c23 -->

<!-- START_020c840b296a3a90c95322b39d2f7801 -->
## admin/albums/savealbum
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/albums/savealbum" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/albums/savealbum"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/albums/savealbum`


<!-- END_020c840b296a3a90c95322b39d2f7801 -->

<!-- START_10fab3c4fc07ed0b1c8f89960ebb184b -->
## admin/albums/approve
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/albums/approve" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/albums/approve"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/albums/approve`


<!-- END_10fab3c4fc07ed0b1c8f89960ebb184b -->

<!-- START_ae0c4e4343b799efb102d30e539ff5e8 -->
## admin/albums/suspend
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/albums/suspend" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/albums/suspend"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/albums/suspend`


<!-- END_ae0c4e4343b799efb102d30e539ff5e8 -->

<!-- START_3bf2cde2b3394fc75f9346d91d0c02ad -->
## admin/albums/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/albums/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/albums/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/albums/view/{id}`


<!-- END_3bf2cde2b3394fc75f9346d91d0c02ad -->

<!-- START_817e0b4c1301d65a35ef55484067dbff -->
## admin/albums/deleteatt
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/albums/deleteatt" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/albums/deleteatt"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/albums/deleteatt`


<!-- END_817e0b4c1301d65a35ef55484067dbff -->

<!-- START_2ca9fd3de35942fbfa4220af579dce6d -->
## admin/albums/reject/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/albums/reject/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/albums/reject/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/albums/reject/{id}`


<!-- END_2ca9fd3de35942fbfa4220af579dce6d -->

<!-- START_4e6af50a0c9c3e6026fc738addaa133b -->
## admin/albums/rejsave
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/albums/rejsave" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/albums/rejsave"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/albums/rejsave`


<!-- END_4e6af50a0c9c3e6026fc738addaa133b -->

<!-- START_185b95ada0f5596e1ce56a9223c4126c -->
## admin/albums/coverimg/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/albums/coverimg/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/albums/coverimg/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/albums/coverimg/{id}`


<!-- END_185b95ada0f5596e1ce56a9223c4126c -->

<!-- START_59fdad118ccc3bc71ab807804fee2dea -->
## admin/albums/coverimg/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/albums/coverimg/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/albums/coverimg/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/albums/coverimg/update`


<!-- END_59fdad118ccc3bc71ab807804fee2dea -->

<!-- START_5a2c2b2a7d0664e0be3af7a1efb24ace -->
## admin/events
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/events" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/events"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/events`


<!-- END_5a2c2b2a7d0664e0be3af7a1efb24ace -->

<!-- START_7df0e6a3bc0718c3a015bcfc70d46324 -->
## admin/events/add
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/events/add" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/events/add"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/events/add`


<!-- END_7df0e6a3bc0718c3a015bcfc70d46324 -->

<!-- START_d55e597569157684b87ed4e9f12fa554 -->
## admin/events/save
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/events/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/events/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/events/save`


<!-- END_d55e597569157684b87ed4e9f12fa554 -->

<!-- START_85ac56ab750db2ca24140d9eb54aa409 -->
## admin/events/edit/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/events/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/events/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/events/edit/{id}`


<!-- END_85ac56ab750db2ca24140d9eb54aa409 -->

<!-- START_6417c531c56ba7a5c7e6764084a8dbeb -->
## admin/events/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/events/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/events/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/events/update`


<!-- END_6417c531c56ba7a5c7e6764084a8dbeb -->

<!-- START_a46618d351e7ac2c2e12926157077839 -->
## admin/events/delete
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/events/delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/events/delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/events/delete`


<!-- END_a46618d351e7ac2c2e12926157077839 -->

<!-- START_247642f0d0d8baebc8931ac0e98b62a0 -->
## admin/events/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/events/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/events/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/events/view/{id}`


<!-- END_247642f0d0d8baebc8931ac0e98b62a0 -->

<!-- START_1a3d3403ce5f36f4ecf54c141593646d -->
## admin/blogs
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/blogs" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/blogs"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/blogs`


<!-- END_1a3d3403ce5f36f4ecf54c141593646d -->

<!-- START_9d7288e02e52d515ab3ea5c5a064fb20 -->
## admin/blogs/for-approval
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/blogs/for-approval" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/blogs/for-approval"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/blogs/for-approval`


<!-- END_9d7288e02e52d515ab3ea5c5a064fb20 -->

<!-- START_e6519e4643782a7c4905a58d89704d50 -->
## admin/blogs/add
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/blogs/add" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/blogs/add"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/blogs/add`


<!-- END_e6519e4643782a7c4905a58d89704d50 -->

<!-- START_526dfa68b4e1e124bbe50b197b92e615 -->
## admin/blogs/save
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/blogs/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/blogs/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/blogs/save`


<!-- END_526dfa68b4e1e124bbe50b197b92e615 -->

<!-- START_4a7fb22a4ef9526e89893908d90e8335 -->
## admin/blogs/edit/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/blogs/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/blogs/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/blogs/edit/{id}`


<!-- END_4a7fb22a4ef9526e89893908d90e8335 -->

<!-- START_eba154172f441b7eb6209fe4adfa202e -->
## admin/blogs/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/blogs/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/blogs/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/blogs/update`


<!-- END_eba154172f441b7eb6209fe4adfa202e -->

<!-- START_1785b10e39a4ce4d114316541fcd37ed -->
## admin/blogs/delete
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/blogs/delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/blogs/delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/blogs/delete`


<!-- END_1785b10e39a4ce4d114316541fcd37ed -->

<!-- START_8be315b7364433aa62879bebe04d6acf -->
## admin/blogs/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/blogs/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/blogs/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/blogs/view/{id}`


<!-- END_8be315b7364433aa62879bebe04d6acf -->

<!-- START_a362071c908d312481591e5681b9ffea -->
## admin/blogs/approve
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/blogs/approve" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/blogs/approve"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/blogs/approve`


<!-- END_a362071c908d312481591e5681b9ffea -->

<!-- START_0cf93896a944478c5ea6e5119f0923c9 -->
## admin/blogs/suspend
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/blogs/suspend" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/blogs/suspend"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/blogs/suspend`


<!-- END_0cf93896a944478c5ea6e5119f0923c9 -->

<!-- START_29cea0217a12b7518d9e38f8366abbd0 -->
## admin/blogs/rejsave
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/blogs/rejsave" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/blogs/rejsave"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/blogs/rejsave`


<!-- END_29cea0217a12b7518d9e38f8366abbd0 -->

<!-- START_4585c5766fb817a3a10a0e872f9396dd -->
## admin/survey
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/survey" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/survey"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/survey`


<!-- END_4585c5766fb817a3a10a0e872f9396dd -->

<!-- START_c25bc307030c2e1b2708335ed3836a1f -->
## admin/survey/add
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/survey/add" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/survey/add"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/survey/add`


<!-- END_c25bc307030c2e1b2708335ed3836a1f -->

<!-- START_dc7b2b80a51f4354ddd0cb36f64e223e -->
## admin/survey/save
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/survey/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/survey/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/survey/save`


<!-- END_dc7b2b80a51f4354ddd0cb36f64e223e -->

<!-- START_c5b6288004dadef2d6b8da8b820f769a -->
## admin/survey/edit/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/survey/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/survey/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/survey/edit/{id}`


<!-- END_c5b6288004dadef2d6b8da8b820f769a -->

<!-- START_5335699fb326514ed29acc22b857cdbf -->
## admin/survey/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/survey/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/survey/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/survey/update`


<!-- END_5335699fb326514ed29acc22b857cdbf -->

<!-- START_2a8453a744fa870c26c749aecf4a0d7f -->
## admin/survey/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/survey/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/survey/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/survey/view/{id}`


<!-- END_2a8453a744fa870c26c749aecf4a0d7f -->

<!-- START_10ebb6590df7c08e09db70bdc6a8949e -->
## admin/survey/surveyField
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/survey/surveyField" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/survey/surveyField"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/survey/surveyField`


<!-- END_10ebb6590df7c08e09db70bdc6a8949e -->

<!-- START_40ea65af1b6947c2de24e05259f52389 -->
## admin/survey/editSurveyField/{id}/{surveyid}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/survey/editSurveyField/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/survey/editSurveyField/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/survey/editSurveyField/{id}/{surveyid}`


<!-- END_40ea65af1b6947c2de24e05259f52389 -->

<!-- START_a07d92bc47d5179ba5c646a277be3fd3 -->
## admin/survey/updateServeyField
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/survey/updateServeyField" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/survey/updateServeyField"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/survey/updateServeyField`


<!-- END_a07d92bc47d5179ba5c646a277be3fd3 -->

<!-- START_c956a385f2bcacddb5b8883980223eee -->
## admin/q4etype
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/q4etype" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4etype"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/q4etype`


<!-- END_c956a385f2bcacddb5b8883980223eee -->

<!-- START_13b3e173eb8b1a62f7822aa3a0a13a48 -->
## admin/q4etype/add
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/q4etype/add" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4etype/add"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/q4etype/add`


<!-- END_13b3e173eb8b1a62f7822aa3a0a13a48 -->

<!-- START_d60934cd7d84524ee6cf12f97f6eb9af -->
## admin/q4etype/save
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/q4etype/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4etype/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/q4etype/save`


<!-- END_d60934cd7d84524ee6cf12f97f6eb9af -->

<!-- START_d221542d044cfe8917d4803428c7f855 -->
## admin/q4etype/edit/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/q4etype/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4etype/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/q4etype/edit/{id}`


<!-- END_d221542d044cfe8917d4803428c7f855 -->

<!-- START_93255323ea065c1a79259771c011ef8d -->
## admin/q4etype/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/q4etype/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4etype/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/q4etype/update`


<!-- END_93255323ea065c1a79259771c011ef8d -->

<!-- START_bdde188a6f09d388677ce0862a540a9b -->
## admin/q4etype/delete
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/q4etype/delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4etype/delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/q4etype/delete`


<!-- END_bdde188a6f09d388677ce0862a540a9b -->

<!-- START_88f339fadd7a1844412d8a4fe02e0516 -->
## admin/q4eforms
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/q4eforms" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/q4eforms`


<!-- END_88f339fadd7a1844412d8a4fe02e0516 -->

<!-- START_5a92addebf1b9224dff1956ca10204b6 -->
## admin/q4eforms/list/{code}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/q4eforms/list/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/list/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/q4eforms/list/{code}`


<!-- END_5a92addebf1b9224dff1956ca10204b6 -->

<!-- START_beb75c7c5a457a2ec89b7a198439a60f -->
## admin/q4eforms/add/{code}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/q4eforms/add/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/add/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/q4eforms/add/{code}`


<!-- END_beb75c7c5a457a2ec89b7a198439a60f -->

<!-- START_5a0f1065bea9405e44ce3c69f1bf8b91 -->
## admin/q4eforms/save
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/q4eforms/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/q4eforms/save`


<!-- END_5a0f1065bea9405e44ce3c69f1bf8b91 -->

<!-- START_79b559f8e2ec7e45fecd7ff8233b89f5 -->
## admin/q4eforms/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/q4eforms/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/q4eforms/view/{id}`


<!-- END_79b559f8e2ec7e45fecd7ff8233b89f5 -->

<!-- START_ebdae9e40edd5baf1dad0d18b84d9cad -->
## admin/q4eforms/preview/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/q4eforms/preview/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/preview/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/q4eforms/preview/{id}`


<!-- END_ebdae9e40edd5baf1dad0d18b84d9cad -->

<!-- START_fda337fc53c3af900d4d504881ebe560 -->
## admin/q4eforms/edit/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/q4eforms/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/q4eforms/edit/{id}`


<!-- END_fda337fc53c3af900d4d504881ebe560 -->

<!-- START_a125b7afb72db54bd9eee92862bccc39 -->
## admin/q4eforms/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/q4eforms/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/q4eforms/update`


<!-- END_a125b7afb72db54bd9eee92862bccc39 -->

<!-- START_a43bdd9f0670e6f597ab04060f8a2023 -->
## admin/q4eforms/delete
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/q4eforms/delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/q4eforms/delete`


<!-- END_a43bdd9f0670e6f597ab04060f8a2023 -->

<!-- START_b115ae9a1442c218b2947b9ad43b37eb -->
## admin/q4eforms/generate/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/q4eforms/generate/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/generate/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/q4eforms/generate/{id}`


<!-- END_b115ae9a1442c218b2947b9ad43b37eb -->

<!-- START_18af6ceac27e3a001762ce8d694e05a7 -->
## admin/q4eforms/assign/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/q4eforms/assign/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/assign/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/q4eforms/assign/{id}`


<!-- END_18af6ceac27e3a001762ce8d694e05a7 -->

<!-- START_b6f065d98e5c51ad7e79435e31421324 -->
## admin/q4eforms/saveSection
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/q4eforms/saveSection" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/saveSection"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/q4eforms/saveSection`


<!-- END_b6f065d98e5c51ad7e79435e31421324 -->

<!-- START_2824c11dea8b63e576390380c473c8dc -->
## admin/q4eforms/deleteSection
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/q4eforms/deleteSection" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/deleteSection"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/q4eforms/deleteSection`


<!-- END_2824c11dea8b63e576390380c473c8dc -->

<!-- START_0068199926f076456e8e04b5c08020cb -->
## admin/q4eforms/section/add/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/q4eforms/section/add/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/section/add/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/q4eforms/section/add/{id}`


<!-- END_0068199926f076456e8e04b5c08020cb -->

<!-- START_f5e8ed8f06e5eedd9a9bc6db532905fb -->
## admin/q4eforms/section/save
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/q4eforms/section/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/section/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/q4eforms/section/save`


<!-- END_f5e8ed8f06e5eedd9a9bc6db532905fb -->

<!-- START_b5c978703f8dc3a7c1539dca0db68165 -->
## admin/q4eforms/section/edit/{id}/{sectionid}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/q4eforms/section/edit/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/section/edit/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/q4eforms/section/edit/{id}/{sectionid}`


<!-- END_b5c978703f8dc3a7c1539dca0db68165 -->

<!-- START_45a8406db8a61094d2dcf33e56022062 -->
## admin/q4eforms/section/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/q4eforms/section/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/section/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/q4eforms/section/update`


<!-- END_45a8406db8a61094d2dcf33e56022062 -->

<!-- START_2bf2525380655925fac3c79bd53106a9 -->
## admin/q4eforms/section/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/q4eforms/section/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/section/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/q4eforms/section/view/{id}`


<!-- END_2bf2525380655925fac3c79bd53106a9 -->

<!-- START_9946f01732a31f05e9d1d51d9d62b6a2 -->
## admin/q4eforms/items/save
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/q4eforms/items/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/items/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/q4eforms/items/save`


<!-- END_9946f01732a31f05e9d1d51d9d62b6a2 -->

<!-- START_26f2b23d2f90b80744e72e06d5cbd784 -->
## admin/q4eforms/items/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/q4eforms/items/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/items/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/q4eforms/items/update`


<!-- END_26f2b23d2f90b80744e72e06d5cbd784 -->

<!-- START_813ed04ecc395a289683c942b71a1d00 -->
## admin/q4eforms/results/save-continue
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/q4eforms/results/save-continue" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/results/save-continue"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/q4eforms/results/save-continue`


<!-- END_813ed04ecc395a289683c942b71a1d00 -->

<!-- START_7faeca5f49d61086315069c64b1a3557 -->
## admin/q4eforms/results/save-complete
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/q4eforms/results/save-complete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/results/save-complete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/q4eforms/results/save-complete`


<!-- END_7faeca5f49d61086315069c64b1a3557 -->

<!-- START_9f561d855ee62827bba46b2bbdcc0245 -->
## admin/q4eforms/assign/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/q4eforms/assign/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/assign/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/q4eforms/assign/view/{id}`


<!-- END_9f561d855ee62827bba46b2bbdcc0245 -->

<!-- START_b2156e6e3ffdac49cb84694a244ad03c -->
## admin/q4eforms/assign/validate
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/q4eforms/assign/validate" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/assign/validate"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/q4eforms/assign/validate`


<!-- END_b2156e6e3ffdac49cb84694a244ad03c -->

<!-- START_625b64ecc4801b9f8a3fcc3c82ffeb14 -->
## admin/q4eforms/assign/export
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/q4eforms/assign/export" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/assign/export"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/q4eforms/assign/export`


<!-- END_625b64ecc4801b9f8a3fcc3c82ffeb14 -->

<!-- START_ce2c259dd498bb119eb2b123ccb9de46 -->
## admin/q4eforms/assign-now/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/q4eforms/assign-now/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/assign-now/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/q4eforms/assign-now/{id}`


<!-- END_ce2c259dd498bb119eb2b123ccb9de46 -->

<!-- START_3f87651384da0917ab85beb0574cf700 -->
## admin/q4eforms/assign-now/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/q4eforms/assign-now/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eforms/assign-now/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/q4eforms/assign-now/update`


<!-- END_3f87651384da0917ab85beb0574cf700 -->

<!-- START_9ab2b0c37780663a0a3e95d4f3dba45e -->
## admin/hod
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/hod" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/hod"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/hod`


<!-- END_9ab2b0c37780663a0a3e95d4f3dba45e -->

<!-- START_5b120090f22a983c9092a2a9ff1c6cfa -->
## admin/hod/add
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/hod/add" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/hod/add"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/hod/add`


<!-- END_5b120090f22a983c9092a2a9ff1c6cfa -->

<!-- START_8e30f64ce863063af881ca5cd04e83c8 -->
## admin/hod/save
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/hod/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/hod/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/hod/save`


<!-- END_8e30f64ce863063af881ca5cd04e83c8 -->

<!-- START_7fb4244fbf1344e761b2f21dce323dfa -->
## admin/hod/edit/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/hod/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/hod/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/hod/edit/{id}`


<!-- END_7fb4244fbf1344e761b2f21dce323dfa -->

<!-- START_0704eb923a247179c65c559b54b5988b -->
## admin/hod/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/hod/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/hod/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/hod/update`


<!-- END_0704eb923a247179c65c559b54b5988b -->

<!-- START_b784295441cd354323a3b84d6b0701e8 -->
## admin/documents-category
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/documents-category" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/documents-category"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/documents-category`


<!-- END_b784295441cd354323a3b84d6b0701e8 -->

<!-- START_4a447dc1da31fba77d099a3b6a39b4be -->
## admin/documents-category/add
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/documents-category/add" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/documents-category/add"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/documents-category/add`


<!-- END_4a447dc1da31fba77d099a3b6a39b4be -->

<!-- START_89775e0adab83263beb50ebf401da88d -->
## admin/documents-category/save
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/documents-category/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/documents-category/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/documents-category/save`


<!-- END_89775e0adab83263beb50ebf401da88d -->

<!-- START_a3f1c94b0d59b207b642a07fa69826d4 -->
## admin/documents-category/edit/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/documents-category/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/documents-category/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/documents-category/edit/{id}`


<!-- END_a3f1c94b0d59b207b642a07fa69826d4 -->

<!-- START_cfcdc8b73b173e6bd411472e36a9e8b9 -->
## admin/documents-category/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/documents-category/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/documents-category/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/documents-category/update`


<!-- END_cfcdc8b73b173e6bd411472e36a9e8b9 -->

<!-- START_89c6594a3468aaf197c12a6663d1a35e -->
## admin/incidents-category
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/incidents-category" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/incidents-category"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/incidents-category`


<!-- END_89c6594a3468aaf197c12a6663d1a35e -->

<!-- START_f2ab0b05482261cdd034803c2e8d6788 -->
## admin/incidents-category/view/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/incidents-category/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/incidents-category/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/incidents-category/view/{id}`


<!-- END_f2ab0b05482261cdd034803c2e8d6788 -->

<!-- START_3cff056c1b6dff7082114c6fefe086a9 -->
## admin/incidents-category/add
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/incidents-category/add" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/incidents-category/add"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/incidents-category/add`


<!-- END_3cff056c1b6dff7082114c6fefe086a9 -->

<!-- START_84b300b0acb7d4b93a5b150ba8928f36 -->
## admin/incidents-category/save
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/incidents-category/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/incidents-category/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/incidents-category/save`


<!-- END_84b300b0acb7d4b93a5b150ba8928f36 -->

<!-- START_260fc8d983dbf4fcfdc779dc3e928928 -->
## admin/incidents-category/edit/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/incidents-category/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/incidents-category/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/incidents-category/edit/{id}`


<!-- END_260fc8d983dbf4fcfdc779dc3e928928 -->

<!-- START_e748f1af1e15f2915285d8e3553b8a9a -->
## admin/incidents-category/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/incidents-category/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/incidents-category/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/incidents-category/update`


<!-- END_e748f1af1e15f2915285d8e3553b8a9a -->

<!-- START_068cd0cb906f2155e9d8e0f092530998 -->
## admin/q4eanswertype
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/q4eanswertype" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eanswertype"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/q4eanswertype`


<!-- END_068cd0cb906f2155e9d8e0f092530998 -->

<!-- START_df2d9f114360f4610c19593b1116eec5 -->
## admin/q4eanswertype/add
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/q4eanswertype/add" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eanswertype/add"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/q4eanswertype/add`


<!-- END_df2d9f114360f4610c19593b1116eec5 -->

<!-- START_62358c161d47a9cf5c495f84cfb60113 -->
## admin/q4eanswertype/save
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/q4eanswertype/save" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eanswertype/save"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/q4eanswertype/save`


<!-- END_62358c161d47a9cf5c495f84cfb60113 -->

<!-- START_9fab5805dd3647531a473b261bbc9e18 -->
## admin/q4eanswertype/edit/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/q4eanswertype/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eanswertype/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET admin/q4eanswertype/edit/{id}`


<!-- END_9fab5805dd3647531a473b261bbc9e18 -->

<!-- START_b49f5cc166c7ada3fa50e4c0a9d2080e -->
## admin/q4eanswertype/update
> Example request:

```bash
curl -X POST \
    "http://localhost/admin/q4eanswertype/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/q4eanswertype/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST admin/q4eanswertype/update`


<!-- END_b49f5cc166c7ada3fa50e4c0a9d2080e -->



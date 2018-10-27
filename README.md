Fake Api Client
===============

PHP Client for [JSONPlaceholder API]( https://jsonplaceholder.typicode.com/)  
This client supports only [Posts](https://jsonplaceholder.typicode.com/posts) model requests.

Requirements
------------
- PHP 7.0
- cURL library

Installation
------------

**Via Composer:**

```bash
composer require arthof/fake-api-client
```

How To Use
----------

```php
require_once(__DIR__ . '/vendor/autoload.php');

use FakeApiClient\Client;
$Client = new Client();
$postId = 1;
$userId = 2;

//[GET] fetch single post 
$post = $Client->Posts->Fetch($postId);

//[GET] fetch all posts
$posts = $Client->Posts->FetchAll();

//[GET] fetch posts by user
$postsByUser = $Client->Posts->FetchByUser($userId);

//[GET] fetch post comments
$postComments = $Client->Posts->FetchComments($postId);

//[POST] create post
$createPost = [
    'title' => 'Lorem ipsum',
    'body' => 'Sample text',
    'userId' => 3,
];
$newPost = $Client->Posts->Create($createPost);

//[PUT] replace post
$postId = 74;
$replacePost = [
    'id' => 74,
    'title' => 'Lorem ipsum',
    'body' => 'Sample text',
    'userId' => 3,
];
$replacedPost= $Client->Posts->Replace($postId, $replacePost);

//[PATCH] update post
$postId = 74;
$replacePost = [
    'title' => 'Winnie the Pooh',
];
$updatedPost = $Client->Posts->Update($postId, $replacePost);

//[DELETE] delete post
$deletedPost = $Client->Posts->Delete($postId);
```

Configuration
----------
If the API URL changes (default: https://jsonplaceholder.typicode.com/) you can pass new URL to the client class in the constructor.  
You can also use different HTTP Client, it just needs to implement IHttpMethods interface.

```php
use FakeApiClient\Client;
$httpClient = new DifferentHttpClient();
$Client = new Client('https://new-api-url/', $httpClient);

```

Extending
----------

To add support for other models just create new class that extends the Resources abstract class and set the TYPE constant.  
Sample for [Todos](https://jsonplaceholder.typicode.com/todos) model:

```php
//src/FakeApiClient/Todos.php
namespace FakeApiClient;

use FakeApiClient\Resources;

class Todos extends Resources
{
    const TYPE = 'todos';
}
```

In Client.php add variable for new model and initialize it in the constructor:

```php
//src/FakeApiClient/Client.php
namespace FakeApiClient;

class Client
{
    public $Posts;
    public $Todos;

    public function __construct(string $baseUrl=null, IHttpMethods $httpClient=null)
    {
        $this->Posts = new Posts($baseUrl, $httpClient);
        $this->Todos = new Todos($baseUrl, $httpClient);
    }
}
```

New model will automatically support metods: 
* show a resource [GET]
* list resources [GET]
* create a resource [POST]
* replace a resource [PUT]
* update a resource [PATCH]
* delete a resource [DELETE]

Sample use:
```php
use FakeApiClient\Client;
$Client = new Client();

//[GET] fetch all todos
$todos = $Client->Todos->FetchAll();
```






# HostHinh API

The way to access the page https://hosthinh.com with the given user

## Getting Started

### Installing

Clone the source from the source control

```
git clone https://github.com/locddspkt/hosthinh-api.git
```

Copy the folder to the project


Include the class

```
include_once '/path/to/the/file/autoload.php';
```

Init the api key and secret key of the given user

```
HostHinh\HostHinhClient::init('api_key', 'secret_key');
```

Upload the image

```
$filePath = 'path_to_the_file_or_url';
$title = 'Title of the image';
$private = true;
$passwordOfTheImage = 'password'
$response = HostHinh\HostHinhClient::upload($filePath, $title, $private, $passwordOfTheImage);
```

Get the link
```
$link = $response['data']['link'];
echo $link;
```


## Running the demo page

The test file is demo/sample.php

## License

This project is licensed under the MIT License

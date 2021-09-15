<!-- ABOUT THE PROJECT -->

## About The Package

Admin Auth template for laravel

### Built With

- [Laravel(Backend)](https://laravel.com/)

<!-- GETTING STARTED -->

## Getting Started

To get a local copy up and running follow these simple steps.

### Prerequisites

This is an example of how to list things you need to use the software and how to install them.

- Composer

### Package Installation

1.  Edit `composer.json` file. Add github repositories.

    ```
    "repositories": [
         {
             "url": "https://github.com/sislamrafi/laravel-admin-auth-pkg.git",
             "type": "vcs"
         }
     ],
    ```

2.  Run Composer Require command
    ```sh
    composer require sislamrafi/admin:dev-main
    ```
3.  Publish package
    ```sh
    php artisan vendor:publish --provider=Sislamrafi\Admin\AdminServiceProvider
    ```
    You can use also tag option to publish a specific tag. List of provider tags ``--tag=`` for this package:
    1. public
    2. config
    3. migrations
    4. config

5.  Edit environment variable (in .env file). Add those variables
    ```
    ADMIN_ACCEPT_REGISTER=false
    ```
    This ``.env`` variable will define if normal visitor in website can open a id in admin panel.
6.  If you add this package to your existing project, don't forget to clear cache
    ```sh
    php artisan optimize:clear
    ```
7. To update run,
    ```sh
    composer update sislamrafi/admin
    ```

<!-- USAGE EXAMPLES -->

## Usage

This package will create `admin\web.php` and `admin\api.php` route in `routes\` folder. You can add your necessary routs for admin panel there
<!-- ROADMAP -->

## Roadmap

See the [open issues](https://github.com/sislamrafi/laravel-admin-auth-pkg/issues) for a list of proposed features (and known issues).

<!-- CONTRIBUTING -->

## Contributing

Contributions are what make the open source community such an amazing place to be learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<!-- LICENSE -->

## License

Distributed under the MIT License. See `LICENSE` for more information.

<!-- CONTACT -->

## Contact

S Islam Rafi - [sislamrafi333@gmail.com](https://www.facebook.com/sislam.rafi/) - email

Project Link: [https://github.com/sislamrafi/laravel-admin-auth-pkg](https://github.com/sislamrafi/laravel-admin-auth-pkg)

<!-- ACKNOWLEDGEMENTS -->


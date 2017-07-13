# gifty

Online Gift Store

## Foreword

After reading Paul M. Jones' [Modernizing Legacy Applications In PHP](https://leanpub.com/mlaphp), I decided to modernize this old project as an exercise. However, considering its size, it is more sensible to perform a complete rewrite, as opposed to iterative refactoring. We'll use the lessons from the book as a starting point though.

[Pitfalls of the legacy Gifty app](https://github.com/alex996/gifty/releases/tag/v0.1.0)

## Roadmap

Below is a tentative roadmap for the future version of Gifty:

- [x] Set up Composer & PSR-4 autoloading ([v1.0.0](https://github.com/alex996/gifty/releases/tag/v1.0.0))
- [ ] Revisit folder structure (ref. [Symfony](http://symfony.com/doc/current/quick_tour/the_architecture.html) and [Laravel](https://laravel.com/docs/master/structure))
- [x] Use namespaces instead of include's ([v1.0.1](https://github.com/alex996/gifty/releases/tag/v1.0.1))
- [ ] Follow PSR-2 styling and PHPDoc comments
- [ ] Use open source components: [Symfony](https://symfony.com/components) & [ThePHPLeague](http://thephpleague.com)
- [ ] Use advanced OOP (interfaces, abstract, meta) + SPL library
- [ ] Use modern PHP 7.1 and 7.0 features (e.g. type hints, return type)
- [x] **Set up an automated test suite with PHPUnit** ([v1.0.1](https://github.com/alex996/gifty/releases/tag/v1.0.1))
- [ ] Write unit/functional/**acceptance** tests (e.g. Codeception)
- [ ] Set up a proper router & Request/Response architecture
- [ ] Set up a proper ORM alleviating N+1 issues (Doctrine or Propel)
- [ ] Set up a D.I. container & use D.I. across the codebase
- [ ] Set up a middleware layer
- [ ] Set up a proper Http/session authentication
- [ ] Set up templating with caching & escaping (Twig or Plates)
- [ ] Make sure to sanitize all foreign inputs (request, cookies, sessions, files)
- [ ] Set up a configuration (.env?) file
- [ ] Configure web server URL rewrite; ignore asset folders ([v1.0.1](https://github.com/alex996/gifty/releases/tag/v1.0.1))
- [ ] Introduce front-end asset management with [Webpack](https://laracasts.com/series/webpack-for-everyone) & Node
- [ ] Reimplement file storage (img, pdf e.g. invoices, etc.) (w/ [Flysystem](http://flysystem.thephpleague.com)?)
- [ ] Add a mailer service
- [ ] Set up Stripe integration (perhaps with [Omnipay](http://omnipay.thephpleague.com))
- [ ] Set up proper ACL / RBAC
- [ ] CSRF, XSS, login throttling, other security protection mechanisms
- [ ] Follow design patterns (SOLID)
- [ ] Set up better exception handling / error reporting for diff env. / logging

Optionally, we'd like to:

1. Migrate to Bootstrap 4
2. Add internationalization and multilanguage support
3. Add timezone support through DateTime / Carbon + front-end (moment)
4. Implement geography-based taxation
5. Set up invoice generation
6. Integrate with Vue.js (non-SPA), axios, etc.
7. Redesign admin dashboard (e.g. [AdminLTE](https://adminlte.io))

## References

Out of my own ignorance purely:

* [Semantic Versioning](http://semver.org)
* [README.md markdown](https://guides.github.com/features/mastering-markdown)
* [Namespaces & PSR-4 by M. Stauffer](https://mattstauffer.co/blog/a-brief-introduction-to-php-namespacing)
* [Create your own Framework with Symfony](http://symfony.com/doc/current/create_framework/index.html)
* [Configuring a web server](http://symfony.com/doc/current/setup/web_server_configuration.html)
* [PSR-2 Coding Style Guide](http://www.php-fig.org/psr/psr-2)

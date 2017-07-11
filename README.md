# gifty

Online Gift Store

## Foreword

After reading Paul M. Jones' ["Modernizing Legacy Applications In PHP"](https://leanpub.com/mlaphp), I decided to modernize this old project as an exercise. However, considering its size, it is more sensible to perform a complete rewrite, as opposed to iteractive refactoring. We'll use the lessons from the book as a starting point though.

[Pitfalls of the legacy Gifty app](https://github.com/alex996/gifty/releases/tag/v0.1.0)

## Roadmap

Below is a tentative roadmap for the future version of Gifty:

1. Set up Composer & PSR-4 autoloading ✓ [v1.0.0](https://github.com/alex996/gifty/releases/tag/v1.0.0)
2. Revisit folder structure (ref. [Symfony](http://symfony.com/doc/current/quick_tour/the_architecture.html) and [Laravel](https://laravel.com/docs/master/structure))
3. Use namespaces instead of include's
4. Follow PSR-2 styling and PHPDoc comments
5. Use open source components: [Symfony](https://symfony.com/components) & [ThePHPLeague](http://thephpleague.com)
5. Use advanced OOP (interfaces, abstract, meta) + SPL library
6. Use modern PHP 7.1 and 7.0 features (e.g. type hints, return type)
7. **Set up a test suite with PHPUnit**, perhaps even browser test automation
8. Set up a proper router & Request/Response architecture
9. Set up a proper ORM alleviating N+1 issues
10. Set up a D.I. container & use D.I. across the codebase
11. Set up a middleware layer
12. Set up a proper Http/session authentication
12. Set up templating with caching & escaping
13. Make sure to sanitize all foreign inputs (request, cookies, sessions, files)
14. Set up a configuration (.env?) file
15. Point the web root to `/public`
16. Introduce front-end asset management with [Webpack](https://laracasts.com/series/webpack-for-everyone) & Node
17. Reimplement file storage (img, pdf e.g. invoices, etc.) (w/ [Flysystem](http://flysystem.thephpleague.com)?)
18. Add a mailer service
19. Set up Stripe integration (perhaps with [Omnipay](http://omnipay.thephpleague.com))
20. Set up proper ACL / RBAC
21. CSRF, XSS, login throttling, other security protection mechanisms
22. Follow design patterns (SOLID)
22. Set up better exception handling / error reporting for diff env. / logging

Otionally, we'd like to:

1. Migrate to Bootstrap 4
2. Add internationalization and multilanguage support
3. Add timezone support through DateTime / Carbon + front-end (moment)
4. Implement geography-based taxation
5. Set up invoice generation
6. Integrate with Vue.js (non-SPA), axios, etc.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Tests

  - Tests\Unit\ProjectTest
  
  ✓ a project has a path method<br/>
  ✓ a project belongs to owner<br/>
  ✓ a project can add a task<br/>

  - Tests\Unit\TaskTest
  
  ✓ a task belongs to a project<br/>
  ✓ a task can be completed<br/>
  ✓ a task can be marked as incomplete<br/>

  - Tests\Unit\UserTest
  
  ✓ a user has projects<br/>

  - Tests\Feature\ActivityFeedTest
  
  ✓ creating a project records activity<br/>
  ✓ updating a project records activity<br/>
  ✓ creating a new task records in project activity<br/>
  ✓ completing a task records in project activity<br/>

  - Tests\Feature\ManageProjectsTest
  
  ✓ an authenticated user can create a project<br/>
  ✓ an authenticated user can view their projects<br/>
  ✓ an authenticated user can update their projects<br/>
  ✓ an authenticated user cant view others projects<br/>
  ✓ an authenticated user cant update others projects<br/>
  ✓ a project requires a title<br/>
  ✓ a project requires a description<br/>
  ✓ guests cant view create page<br/>
  ✓ guests cant create projects<br/>
  ✓ guests cant view projects<br/>
  ✓ guests cant view a single project<br/>
  ✓ guests cant view edit project page<br/>

  - Tests\Feature\ProjectTasksTest
  
  ✓ a project can have tasks<br/>
  ✓ only the owner of the project can add tasks<br/>
  ✓ only the owner of the project can update tasks<br/>
  ✓ a task can be updated<br/>
  ✓ a task can be completed<br/>
  ✓ a task can be marked as incomplete<br/>
  ✓ a task requires a body<br/>

  - Tests:  30 passed
  
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

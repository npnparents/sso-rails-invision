<!-- PROJECT SHIELDS -->
<!--
*** I'm using markdown "reference style" links for readability.
*** Reference links are enclosed in brackets [ ] instead of parentheses ( ).
*** See the bottom of this document for the declaration of the reference variables
*** for contributors-url, forks-url, etc. This is an optional, concise syntax you may use.
*** https://www.markdownguide.org/basic-syntax/#reference-style-links
-->
[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]



<!-- PROJECT LOGO -->
<br />
<p align="center">
  
  <h3 align="center">SSO-RAILS-INVISION</h3>

  <p align="center">
    Invision Community has a built in API that allows for exchanging member data. However, in creating a Rails application to login users, we wanted additional information to pass to the application that facilitates different uses. For instance, adding custom access and functionalities to the Invision forums.
    <br />
    <a href="https://github.com/npnparents/sso-rails-invision"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/npnparents/sso-rails-invision/issues">Report Bug</a>
    ·
    <a href="https://github.com/npnparents/sso-rails-invision/issues">Request Feature</a>
  </p>
</p>



<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary><h2 style="display: inline-block">Table of Contents</h2></summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgements">Acknowledgements</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project

Invision Community has a built in API that allows for exchanging member data. However, in creating a Rails application to login users, we wanted additional information to pass to the application that facilitates different uses. For instance, adding custom access and functionalities to the Invision foru

You can find this installed applications in the `applications` directory and can be installed in `System -> Site Features -> Applications`.

* Custom application . This application enables REST Urls in order to create/delete forum members. The following urls are enable after you installed this application:

`GET /npn/hello`: Used to verify that the application is configured and you can conect to the forum.

`POST /npn/members`: Used for creating new forum members.

`POST /npn/members/{id}`: Used for updating an existing forum member.

`DELETE /npn/members/{id}`: Used for deleting an existing forum member.

* Every request to the forum needs to include a `API Key`. You can generate a `API Key` in `System -> REST API -> API Keys`. This key is included in the request as basic auth, the `API Key` is the `user` and leave the `password` as blank.

*Note*: You can get more details about these actions (like the expected attributes) in the following section of the forum: `System -> REST API -> API Reference` under `NPN section`.


### Built With

* [Invision Community](https://www.invisioncommunity.com)
* [PHP](https://www.php.net)
* [Rails](https://rubyonrails.org) Or any system to send/recv API queries



<!-- GETTING STARTED -->
## Getting Started

To get a local copy up and running follow these simple steps.

### Prerequisites

* Invision Community v4.4.x or better
* PHP (of course)
  

### Installation

1. Clone the repo
   ```sh
   git clone https://github.com/npnparents/sso-rails-invision.git
   ```
2. Drag entire folder to invision_root/applications folder
   ```sh
   cp sso-rails-invision <invision_root>/applications
   ```
3. From the Invision UI, go to System > Applications
4. Look for the SSO-RAILS-INVISION application, click install



<!-- USAGE EXAMPLES -->
## Usage

Use this space to show useful examples of how a project can be used. Additional screenshots, code examples and demos work well in this space. You may also link to more resources.

_For more examples, please refer to the [Documentation](#)_



<!-- ROADMAP -->
## Roadmap

See the [open issues](https://github.com/npnparents/sso-rails-invision/issues) for a list of proposed features (and known issues).



<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to be learn, inspire, and create.
Any contributions you make are **greatly appreciated**.

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

Network Neighborhood of Chicago - [@npnparents](https://twitter.com/npnparents) - email

Project Link: [https://github.com/npnparents/sso-rails-invision](https://github.com/npnparents/sso-rails-invision)



<!-- ACKNOWLEDGEMENTS -->
## Acknowledgements

* [Solo Group, Inc.](www.sologroup.com)
* [TableXI](www.tablexi.com)
* [Invision Power Services](invisioncommunity.com)





<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/npnparents/sso-rails-invision.svg?style=for-the-badge
[contributors-url]: https://github.com/npnparents/sso-rails-invision/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/npnparents/sso-rails-invision.svg?style=for-the-badge
[forks-url]: https://github.com/npnparents/sso-rails-invision/network/members
[stars-shield]: https://img.shields.io/github/stars/npnparents/sso-rails-invision.svg?style=for-the-badge
[stars-url]: https://github.com/npnparents/sso-rails-invision/stargazers
[issues-shield]: https://img.shields.io/github/issues/npnparents/sso-rails-invision.svg?style=for-the-badge
[issues-url]: https://github.com/npnparents/sso-rails-invision/issues
[license-shield]: https://img.shields.io/github/license/npnparents/sso-rails-invision.svg?style=for-the-badge
[license-url]: https://github.com/npnparents/sso-rails-invision/blob/master/LICENSE.md


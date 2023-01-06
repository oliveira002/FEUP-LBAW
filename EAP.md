# EAP: Architecture Specification and Prototype

## A7: Web Resources Specification

> Indicating the resource catalog, individual resource characteristics, and the JSON response format, this item describes the architecture of the web application that will be created. Using YAML, this specification complies with the OpenAPI standard.

> The documentation for WeBid, including the CRUD (create, read, update, delete) methods for each resource, is included in this item.

### 1. Overview

> The modules are listed and briefly discussed in this part, which also provides an overview of the web application that has to be implemented. The particular documentation of each module under the OpenAPI specification includes a list of the web resources connected to it.

<table>
  <tr>
    <th>M01: Authentication and Individual Profile</th>
    <td>Web resources associated with user authentication and individual profile management. Includes the following system features: login/logout, registration, credential recovery, view and edit personal profile information.</td>
  </tr>
  <tr>
    <th>M02: Auctions</th>
    <td>Web resources associated with auctions. Includes the following system features: auctions searching and listing, viewing and editing details and deleting auctions</td>
  </tr>
  <tr>
    <th>M03: Bidding</th>
    <td>Web resources associated with bids. Includes the following system features: view bids, add bids and remove bids.</td>
  </tr>
  <tr>
    <th>M04: Search Api And Search Pages</th>
    <td>Web resources associated with searching. Includes the following system features: auction searching, user searching.</td>
  </tr>
  <tr>
    <th>M05: User Administration and Static pages</th>
    <td>Web resources associated with user management, specifically: view and search users, delete or block user accounts, view and change user information, and view system access details for each user. Web resources with static content that are associated with this module: admin dashboard, about, contact, services and FAQ.</td>
  </tr>
  <tr>
    <th>M06: User To User Interactions and Notifications</th>
    <td>Web resources associated with reviews and favourites. Includes the following system features: add review, list reviews and delete reviews; add auctions/users to favourites list and remove auctions/users from the favourites list.</td>
  </tr>
</table>

### 2. Permissions

> This section describes the permissions that are used in the modules to set the terms of resource access.

<table>
  <tr>
    <th>PUB</th>
    <td>Public</td>
    <td>Users without privileges.</td>
  </tr>
  <tr>
    <th>USR</th>
    <td>User</td>
    <td>Authenticated users</td>
  </tr>
   <tr>
    <th>OWN</th>
    <td>Owner</td>
    <td>Users that are owners of the information (e.g. own profile, own auctions, own bids)</td>
  </tr>
  <tr>
    <th>ADM</th>
    <td>Administrator</td>
    <td>System Managers</td>
  </tr>
</table>  

### 3. OpenAPI Specification

OpenAPI specification in YAML format to describe the web application's web resources.

Link to the `a7_openapi.yaml` file in the group's repository.
[a7_openapi.yaml](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/a7_openapi.yaml)


```yaml
openapi: 3.0.0

info:
  version: '1.0'
  title: 'WeBid'
  description: 'Web Resources Specification (A7) for WeBid'

servers:
- url: https://lbaw2225.lbaw.fe.up.pt/
  description: Production server

externalDocs:
  description: Find more info here.
  url: https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/wikis/3.-EAP:-Architecture-Specification-and-Prototype#a7-web-resources-specification

tags:
  - name: 'M01: Authentication and Individual Profile'
  - name: 'M02: Auctions'
  - name: 'M03: Bidding'
  - name: 'M04: Search Api And Search Pages'
  - name: 'M05: User Administration and Static pages'
  - name: 'M06: User To User Interactions and Notifications'

paths:

  /login:
    get:
      operationId: 'R101'
      summary: 'R101: Login Form'
      description: 'Provide login form. Access: PUB'
      tags:
        - 'M01: Authentication and Individual Profile'
      responses:
        '200':
          description: 'OK. Show Login form UI'
    post:
      operationId: 'R102'
      summary: 'R102: Login Action'
      description: 'Process login form. Access: PUB'
      tags:
        - 'M01: Authentication and Individual Profile'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                email:
                  type: string
                password:
                  type: string
              required:
                - email
                - password

      responses:
        '302':
          description: 'Redirect after processing the login credentials.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful authentication. Redirect to Home page.'
                  value: '/'
                302Error:
                  description: 'Failed authentication. Redirect to login form.'
                  value: '/login'
  /logout:
    post:
      operationId: 'R103'
      summary: 'R103: Logout Action'
      description: 'Process logout action of current authenticated user. Access: USR, ADM'
      tags:
        - 'M01: Authentication and Individual Profile'
      responses:
        '302':
          description: 'Redirect after processing logout.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful logout. Redirect to Home Page.'
                  value: '/login'
  /register:
    get:
      operationId: 'R104'
      summary: 'R104: Register Form'
      description: 'Provide new user register form. Access: PUB'
      tags:
        - 'M01: Authentication and Individual Profile'
      responses:
        '200':
          description: 'OK. Show Register form UI'
    post:
      operationId: 'R105'
      summary: 'R105: Register Action'
      description: 'Process new user register form. Access: PUB'
      tags:
        - 'M01: Authentication and Individual Profile'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                username:
                  type: string
                email:
                  type: string
                password:
                  type: string
                firstname:
                  type: string
                lastname:
                  type: string
              required:
                - username
                - email
                - password
                - firstname
                - lastname
      responses:
        '302':
          description: 'Redirect after processing new user information.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful registration. Redirect to Home page.'
                  value: '/'
                302Error:
                  description: 'Failed registration. Redirect to register form.'
                  value: '/register'
  /profile/{username}:
    get:
      operationId: 'R106'
      summary: 'R106: View User Profile Page'
      description: 'Show the User profile. Access: PUB'
      tags:
        - 'M01: Authentication and Individual Profile'
      parameters:
        - in: path
          name: username
          description: 'Username of the user to show the profile.'
          required: true
          schema:
            type: string
      responses:
        '200':
          description: 'OK. Show Profile page UI'
          headers:
            Location:
              schema:
                type: string
              examples:
                200Authenticated:
                  description: 'If user the user that is being viewd is Authenticated. View full User Profile.'
                  value: '/users/{username}'
                302Unauthenticate:
                  description: 'If user the user that is being viewd is not Authenticated. View partial User Profile.'
                  value: '/users/{username}'
  /profile/{username}/mydetails:
    get:
      operationId: 'R107'
      summary: 'R107: Edit User Profile Form'
      description: 'Provide edit user profile form. Access: USR, ADM'
      tags:
        - 'M01: Authentication and Individual Profile'
      parameters:
        - in: path
          name: username
          description: 'Username of the user to show the profile.'
          required: true
          schema:
            type: string
      responses:
        '200':
          description: 'OK. Show Edit Profile form UI'
    put:
      operationId: 'R108'
      summary: 'R108: Edit User Profile Action'
      description: 'Process edit user profile form. Access: USR, ADM'
      tags:
        - 'M01: Authentication and Individual Profile'
      parameters:
        - in: path
          name: username
          description: 'Username of the user to show the profile.'
          required: true
          schema:
            type: string
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                username:
                  type: string
                email:
                  type: string
                firstname:
                  type: string
                lastname:
                  type: string
                phonenumber:
                  type: string
              required:
                - username
                - email
                - password
                - firstname
                - lastname
                - phonenumber
      responses:
        '302':
          description: 'Redirect after processing edit user profile information.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful edit. Redirect to User Profile page.'
                  value: '/profile/{username}'
                302Error:
                  description: 'Failed edit. Redirect to Edit Profile form.'
                  value: '/profile/{username}/mydetails'

  /profile/{username}/mypassword:
    put:
      operationId: 'R109'
      summary: 'R109: Edit User Password Action'
      description: 'Process edit user password form. Access: USR, ADM'
      tags:
        - 'M01: Authentication and Individual Profile'
      parameters:
        - in: path
          name: username
          description: 'Username of the user to show the profile.'
          required: true
          schema:
            type: string
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                password:
                  type: string
                newpassword:
                  type: string
                newpasswordconfirmation:
                  type: string
              required:
                - password
                - newpassword
                - newpasswordconfirmation
      responses:
        '302':
          description: 'Redirect after processing edit user password information.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful edit. Redirect to User Profile page.'
                  value: '/profile/{username}'
                302Error:
                  description: 'Failed edit. Redirect to Edit Profile form.'
                  value: '/profile/{username}/mydetails'

  /profile/{username}/balance:
    get:
      operationId: 'R110'
      summary: 'R110: View User Balance'
      description: 'Show the User balance. Access: USR, ADM'
      tags:
        - 'M01: Authentication and Individual Profile'
      parameters:
        - in: path
          name: username
          description: 'Username of the user to show the profile.'
          required: true
          schema:
            type: string
      responses:
        '200':
          description: 'OK. Show Balance page UI'
    post:
      operationId: 'R111'
      summary: 'R111: Add User Balance'
      description: 'Add balance to the User. Access: USR, ADM'
      tags:
        - 'M01: Authentication and Individual Profile'
      parameters:
        - in: path
          name: username
          description: 'Username of the user to show the profile.'
          required: true
          schema:
            type: string
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                amount:
                  type: number
              required:
                - amount
      responses:
        '302':
          description: 'Redirect after processing add balance.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful add balance. Redirect to Balance page.'
                  value: '/profile/{username}/balance'
                302Error:
                  description: 'Failed add balance. Redirect to Balance page.'
                  value: '/profile/{username}/balance'

  /profile/{username}/myauctions:
    get:
      operationId: 'R112'
      summary: 'R112: View User Auctions'
      description: 'Show the User auctions. Access: USR, ADM'
      tags:
        - 'M01: Authentication and Individual Profile'
      parameters:
        - in: path
          name: username
          description: 'Username of the user to show the profile.'
          required: true
          schema:
            type: string
      responses:
        '200':
          description: 'OK. Show Auctions page UI'
  /profile/{username}/mybids:
    get:
      operationId: 'R113'
      summary: 'R113: View User Bids'
      description: 'Show the User bids. Access: USR, ADM'
      tags:
        - 'M01: Authentication and Individual Profile'
      parameters:
        - in: path
          name: username
          description: 'Username of the user to show the profile.'
          required: true
          schema:
            type: string
      responses:
        '200':
          description: 'OK. Show Bids page UI'
  /auction/{id}:
    get:
      operationId: 'R201'
      summary: 'R201: View Auction'
      description: 'Show the Auction details. Access: PUB'
      tags:
        - 'M02: Auctions'
      parameters:
        - in: path
          name: id
          description: 'ID of the auction to show.'
          required: true
          schema:
            type: string
      responses:
        '200':
          description: 'OK. Show Auction page UI'
    post:
      operationId: 'R301'
      summary: 'R301: Add a Bid'
      description: 'Bid on a certain Auction as a authenticated user'
      tags:
        - 'M03: Bidding'
      parameters:
        - in: path
          name: id
          description: 'ID of the auction to show.'
          required: true
          schema:
            type: string
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                amount:
                  type: number
                id:
                  type: number
              required:
                - amount
                - id
      responses:
        '302':
          description: 'Redirect after processing Bid on Auction.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful bid. Redirect to Auction details.'
                  value: '/auction/{id}'
                302Error:
                  description: 'Failed edit. Redirect to Auction details.'
                  value: '/auction/{id}'

    delete:
      operationId: 'R202'
      summary: 'R202: Delete Auction Action'
      description: 'Process delete Auction form. Access: USR, ADM'
      tags:
        - 'M02: Auctions'
      parameters:
        - in: path
          name: id
          description: 'ID of the auction to show.'
          required: true
          schema:
            type: string
      responses:
        '302':
          description: 'Redirect after processing Auction Delete.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful Delete. Redirect to Home page.'
                  value: '/'
        '403':
          description: 'Forbidden. Redirect to Home page.'
          headers:
            Location:
              schema:
                type: string
              examples:
                403Error:
                  description: 'Forbidden. Redirect to Home page.'
                  value: '/'

  /auction/{id}/edit:
    put:
      operationId: 'R203'
      summary: 'R203: Update Auction Action'
      description: 'Process edit Auction form. Access: USR, ADM'
      tags:
        - 'M02: Auctions'
      parameters:
        - in: path
          name: id
          description: 'ID of the auction to show.'
          required: true
          schema:
            type: string
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                name:
                  type: string
                idcategory:
                  type: number
                description:
                  type: string
                startingprice:
                  type: number
                currentprice:
                  type: number
                enddate:
                  type: string
              required:
                - name
                - idcategory
                - description
                - startingprice
                - currentprice
                - enddate
      responses:
        '302':
          description: 'Redirect after processing Auction Form.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful Update. Redirect to Auction details.'
                  value: '/auction/{id}'
                302Error:
                  description: 'Failed Update. Redirect to Auction details.'
                  value: '/auction/{id}'
        '403':
          description: 'Forbidden. Redirect to Home page.'
          headers:
            Location:
              schema:
                type: string
              examples:
                403Error:
                  description: 'Forbidden. Redirect to Home page.'
                  value: '/'
    get:
      operationId: 'R204'
      summary: 'R204: Edit Auction Form'
      description: 'Show the Auction edit form. Access: USR, ADM'
      tags:
        - 'M02: Auctions'
      parameters:
        - in: path
          name: id
          description: 'ID of the auction to show.'
          required: true
          schema:
            type: string
      responses:
        '200':
          description: 'OK. Show Auction Edit page UI'

  /auction/create:
    get:
      operationId: 'R205'
      summary: 'R205: Create Auction Form'
      description: 'Show the Auction create form. Access: USR, ADM'
      tags:
        - 'M02: Auctions'
      responses:
        '200':
          description: 'OK. Show Auction Create page UI'

  /auction:
    post:
      operationId: 'R206'
      summary: 'R206: Create Auction Action'
      description: 'Process create Auction form. Access: USR, ADM'
      tags:
        - 'M02: Auctions'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                name:
                  type: string
                idcategory:
                  type: number
                description:
                  type: string
                startingprice:
                  type: number
                currentprice:
                  type: number
                enddate:
                  type: string
              required:
                - name
                - idcategory
                - description
                - startingprice
                - currentprice
                - enddate
      responses:
        '302':
          description: 'Redirect after processing Auction Form.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful Create. Redirect to Auction details.'
                  value: '/auction/{id}'
                302Error:
                  description: 'Failed Create. Redirect to Auction details.'
                  value: '/auction/{id}'
        '403':
          description: 'Forbidden. Redirect to Home page.'
          headers:
            Location:
              schema:
                type: string
              examples:
                403Error:
                  description: 'Forbidden. Redirect to Home page.'
                  value: '/'
  /search:
    get:
      operationId: 'R401'
      summary: 'R401: Search Page'
      description: 'Show the Search page. Access: PUB'
      tags:
        - 'M04: Search Api And Search Pages'
      parameters:
        - in: query
          name: query_search
          description: 'Search query.'
          required: false
          schema:
            type: string
        - in: query
          name: category
          description: 'Auction Category.'
          required: false
          schema:
            type: number
      responses:
        '200':
          description: 'OK. Show Search page UI'
  /search/api:
    get:
      operationId: 'R402'
      summary: 'R402: Search Auctions Api'
      description: 'Search Auctions and returns result as JSON. Access: PUB'
      tags:
        - 'M04: Search Api And Search Pages'
      parameters:
        - in: query
          name: query_search
          description: 'Search query.'
          required: false
          schema:
            type: string
        - in: query
          name: category
          description: 'Auction Category.'
          required: false
          schema:
            type: number
      responses:
        '200':
          description: 'Success'
          content:
            application/json:
              schema:
                type: array
                items:
                  type: object
                  properties:
                    idauction:
                      type: number
                    name:
                      type: string
                    startdate:
                      type: string
                    enddate:
                      type: string
                    startingprice:
                      type: number
                    currentprice:
                      type: number
                    description:
                      type: string
                    isover:
                      type: boolean
                    idcategory:
                      type: number
                    idowner:
                      type: number
                    tsvectors:
                      type: string
                example:
                  - idauction: 11
                  - name: 'Camera'
                  - startdate: '2022-10-02T10:18:06.000000Z'
                  - enddate: '2022-11-21T13:35:09.000000Z'
                  - startingprice: 50
                  - currentprice: 50
                  - description: 'Polaroid i20X29 20.0MP Digital Camera'
                  - isover: false
                  - idcategory: 7
                  - idowner: 10
                  - tsvectors: "20.0':4B 'camera':1A,7B 'digit':6B 'i20x29':3B 'mp':5B 'polaroid':2B"
  /search/auction/api:
    get:
      operationId: 'R403'
      summary: 'R403: Search Auctions Api'
      description: 'Search Auctions and returns result as JSON. Access: PUB'
      tags:
        - 'M04: Search Api And Search Pages'
      parameters:
        - in: query
          name: query_search
          description: 'Search query.'
          required: false
          schema:
            type: string
      responses:
        '200':
          description: 'Success'
          content:
            application/json:
              schema:
                type: array
                items:
                  type: object
                  properties:
                    idauction:
                      type: number
                    name:
                      type: string
                    startdate:
                      type: string
                    enddate:
                      type: string
                    startingprice:
                      type: number
                    currentprice:
                      type: number
                    description:
                      type: string
                    isover:
                      type: boolean
                    idcategory:
                      type: number
                    idowner:
                      type: number
                    tsvectors:
                      type: string
                example:
                  - idauction: 11
                  - name: 'Camera'
                  - startdate: '2022-10-02T10:18:06.000000Z'
                  - enddate: '2022-11-21T13:35:09.000000Z'
                  - startingprice: 50
                  - currentprice: 50
                  - description: 'Polaroid i20X29 20.0MP Digital Camera'
                  - isover: false
                  - idcategory: 7
                  - idowner: 10
                  - tsvectors: "20.0':4B 'camera':1A,7B 'digit':6B 'i20x29':3B 'mp':5B 'polaroid':2B"

  /search/{category}:
    get:
      operationId: 'R404'
      summary: 'R404: Search Page with filter'
      description: 'Show the Search page for a specific Category. Access: PUB'
      tags:
        - 'M04: Search Api And Search Pages'
      parameters:
        - in: query
          name: query_search
          description: 'Search query.'
          required: false
          schema:
            type: string
        - in: path
          name: category
          description: 'Auction Category.'
          required: true
          schema:
            type: number
      responses:
        '200':
          description: 'OK. Show Search page UI'

  /search/user/api:
    get:
      operationId: 'R405'
      summary: 'R405: Search Users Api'
      description: 'Search Users and returns result as JSON. Access: PUB'
      tags:
        - 'M04: Search Api And Search Pages'
      parameters:
        - in: query
          name: query_search
          description: 'Search query.'
          required: false
          schema:
            type: string
      responses:
        '200':
          description: 'Success'
          content:
            application/json:
              schema:
                type: array
                items:
                  type: object
                  properties:
                    idclient:
                      type: number
                    username:
                      type: string
                    email:
                      type: string
                    firstname:
                      type: string
                    lastname:
                      type: string
                    address:
                      type: string
                    phonenumber:
                      type: string
                    isbanned:
                      type: boolean
                    balance:
                      type: number
                example:
                  - idclient: 1
                  - username: 'cminister0'
                  - email: 'cminister0'
                  - firstname: 'Constantina'
                  - lastname: 'Minister'
                  - address: '42749 Holmberg Trail'
                  - phonenumber: '2516074366'
                  - isbanned: false
                  - balance: 0
  /admin:
    get:
      operationId: 'R501'
      summary: 'R501: Admin Page'
      description: 'Show the Admin page. Access: ADM'
      tags:
        - 'M05: User Administration and Static pages'
      responses:
        '200':
          description: 'OK. Show Admin page UI'
        '403':
          description: 'Forbidden. User is not an Admin.'
  /admin/users:
    get:
      operationId: 'R502'
      summary: 'R502: Admin Users Page'
      description: 'Show the Admin Users page. Access: ADM'
      tags:
        - 'M05: User Administration and Static pages'
      responses:
        '200':
          description: 'OK. Show Admin Users page UI'
        '403':
          description: 'Forbidden. User is not an Admin.'
  /admin/createuser:
    get:
      operationId: 'R503'
      summary: 'R503: Admin Create User Page'
      description: 'Show the Admin Create User page. Access: ADM'
      tags:
        - 'M05: User Administration and Static pages'
      responses:
        '200':
          description: 'OK. Show Admin Create User page UI'
        '403':
          description: 'Forbidden. User is not an Admin.'
  /admin/auctions:
    get:
      operationId: 'R504'
      summary: 'R504: Admin Auctions Page'
      description: 'Show the Admin Auctions page. Access: ADM'
      tags:
        - 'M05: User Administration and Static pages'
      responses:
        '200':
          description: 'OK. Show Admin Auctions page UI'
        '403':
          description: 'Forbidden. User is not an Admin.'
  /admin/bids:
    get:
      operationId: 'R505'
      summary: 'R505: Admin Bids Page'
      description: 'Show the Admin Bids page. Access: ADM'
      tags:
        - 'M05: User Administration and Static pages'
      responses:
        '200':
          description: 'OK. Show Admin Bids page UI'
        '403':
          description: 'Forbidden. User is not an Admin.'
  /profile/{username}/edit:
    get:
      operationId: 'R506'
      summary: 'R601: Edit User Profile Page'
      description: 'Show the Admin Edit User Profile page. Access: ADM'
      tags:
        - 'M05: User Administration and Static pages'
      parameters:
        - in: path
          name: username
          description: 'Username of the user.'
          required: true
          schema:
            type: string
      responses:
        '200':
          description: 'OK. Show Edit Profile page UI'
        '403':
          description: 'Forbidden. User is not an admin.'
  /admin/users/{id}:
    delete:
      operationId: 'R507'
      summary: 'R507: Delete User Action'
      description: 'Delete a User. Access: ADM'
      tags:
        - 'M05: User Administration and Static pages'
      parameters:
        - in: path
          name: id
          description: 'ID of the user.'
          required: true
          schema:
            type: number
      responses:
        '302':
          description: 'Redirect after processing Auction Form.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful Delete. Redirect to Admin user Page.'
                  value: '/admin/users'
                302Error:
                  description: 'Failed Delete. Redirect to admin user details.'
                  value: '/admin/users'
        '403':
          description: 'Forbidden. User is not an admin.'
  /about:
    get:
      operationId: 'R508'
      summary: 'R508: View About Page'
      description: 'View the About Page. Access: PUB'
      tags:
        - 'M05: User Administration and Static pages'
      responses:
        '200':
          description: 'Ok. Show'

  /contacts:
    get:
      operationId: 'R509'
      summary: 'R509: View Contact Page'
      description: 'View the Contact Page. Access: PUB'
      tags:
        - 'M05: User Administration and Static pages'
      responses:
        '200':
          description: 'Ok. Show'

  /FAQs:
    get:
      operationId: 'R510'
      summary: 'R510: View FAQ Page'
      description: 'View the FAQ Page. Access: PUB'
      tags:
        - 'M05: User Administration and Static pages'
      responses:
        '200':
          description: 'Ok. Show'

  /profile/{username}/review:
    get:
      operationId: 'R601'
      summary: 'R601: Review User Profile Page'
      description: 'Show the Review User Profile page. Access: PUB'
      tags:
        - 'M06: User To User Interactions and Notifications'
      parameters:
        - in: path
          name: username
          description: 'Username of the user.'
          required: true
          schema:
            type: string
      responses:
        '200':
          description: 'OK. Show Review Profile page UI'
    post:
      operationId: 'R602'
      summary: 'R602: Review User Action'
      description: 'Review a User. Access: USR'
      tags:
        - 'M06: User To User Interactions and Notifications'
      parameters:
        - in: path
          name: username
          description: 'Username of the user.'
          required: true
          schema:
            type: string
      requestBody:
        description: 'Review Form'
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                rating:
                  type: number
                  description: 'Rating of the user.'
                  minimum: 1
                  maximum: 5
                review:
                  type: string
                  description: 'Review of the user.'
                iduserreviewer:
                  type: number
                  description: 'ID of the user reviewer.'
                iduserreviewed:
                  type: number
                  description: 'ID of the user reviewed.'
              required:
                - rating
                - review
            examples:
              ReviewForm:
                value:
                  rating: 5
                  review: 'Great seller!'
                  iduserreviewer: 1
                  iduserreviewed: 2
      responses:
        '302':
          description: 'Redirect after processing Review Form.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful Review. Redirect to Review Profile Page.'
                  value: '/profile/{username}/review'
                302Error:
                  description: 'Failed Review. Redirect to Review Profile Page.'
                  value: '/profile/{username}/review'
        '403':
          description: 'Forbidden. User is not logged in.'
  /profile/{username}/report:
    get:
      operationId: 'R603'
      summary: 'R603: Report User Profile Page'
      description: 'Show the Report User Profile page. Access: PUB'
      tags:
        - 'M06: User To User Interactions and Notifications'
      parameters:
        - in: path
          name: username
          description: 'Username of the user.'
          required: true
          schema:
            type: string
      responses:
        '200':
          description: 'OK. Show Report Profile page UI'
    post:
      operationId: 'R604'
      summary: 'R604: Report User Action'
      description: 'Report a User. Access: USR'
      tags:
        - 'M06: User To User Interactions and Notifications'
      parameters:
        - in: path
          name: username
          description: 'Username of the user.'
          required: true
          schema:
            type: string
      requestBody:
        description: 'Report Form'
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                review:
                  type: string
                  description: 'Review of the user.'
                idseller:
                  type: number
                  description: 'ID of the seller.'
                idreporter:
                  type: number
                  description: 'ID of the reporter.'
              required:
                - rating
                - review
            examples:
              ReviewForm:
                value:
                  review: 'Worst seller!'
                  idseller: 1
                  idreporter: 2
      responses:
        '302':
          description: 'Redirect after processing Report Form.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful Report. Redirect to Report Profile Page.'
                  value: '/profile/{username}/report'
                302Error:
                  description: 'Failed Report. Redirect to Report Profile Page.'
                  value: '/profile/{username}/report'
        '403':
          description: 'Forbidden. User is not logged in.'

  /profile/{username}/notification:
    get:
      operationId: 'R605'
      summary: 'R605: User Notification Json'
      description: 'Get the User Notification Json. Access: USR'
      tags:
        - 'M06: User To User Interactions and Notifications'
      parameters:
        - in: path
          name: username
          description: 'Username of the user.'
          required: true
          schema:
            type: string
      responses:
        '200':
          description: 'Success'
          content:
            application/json:
              schema:
                type: array
                items:
                  type: object
                  properties:
                    idnotification:
                      type: number
                    content:
                      type: string
                    isread:
                      type: boolean
                    idclient:
                      type: number
                example:
                  - idnotification: 1
                  - content: 'You have a new review!'
                  - isread: false
                  - idclient: 1
  /profile/{username}/favorites:
    get:
      operationId: 'R606'
      summary: 'R606: Favorites User Profile Page'
      description: 'Show the Favorites User Profile page. Access: USR, ADM'
      tags:
        - 'M06: User To User Interactions and Notifications'
      parameters:
        - in: path
          name: username
          description: 'Username of the user.'
          required: true
          schema:
            type: string
      responses:
        '200':
          description: 'OK. Show Favorites Profile page UI'
        '403':
          description: 'Forbidden. User is not logged in.'
```
---


## A8: Vertical prototype

> The features indicated in the common and theme requirements documents as necessary are implemented in the Vertical Prototype. 
> This artifact seeks to verify the proposed architecture, and is 
based on the [LBAW Framework](https://git.fe.up.pt/lbaw/template-laravel). 
> The implementation entails work on the user interface, business logic, and data access levels of the solution's architecture.

### 1. Implemented Features

#### 1.1. Implemented User Stories

| User Story reference | Name                   | Priority                   | Description                   |
| -------------------- | ---------------------- | -------------------------- | ----------------------------- |
| US01 | View Users Profile           | High | As a User, I want to view the other users profile, so that I can see who I am interacting with. |
| US02 | Search Auctions              | High | As a User, I want to search auctions, so that I can find the products I’m looking for. |
| US03 | View Active Auctions         | High | As a User, I want to view the active auctions, so that I can see if any product interests me. |
| US04 | View Own Profile             | High | As a User, I want to view my own profile, so that I know what personal information is being publicly displayed. |
| US05 | View Home Page               | High | As a User, I want to access the home page, so that I can see a short exhibition of the website. |
| US06 | View Auction Info            | High | As a User, I want to view an auction, so that I can know more information about it. |
| US07 | Browse Auctions by Category  | Medium | As a User, I want to browse auctions by category, so that I can find what I am searching for with ease. |
| US08 | Contextual Errors            | Medium | As a User, I want to get contextual error messages, so that I can know what I'm doing wrong at a specific moment |
| US09 | Contextual Help              | Medium | As a User, I want to get contextual help messages (aka tooltips), so that I can get the information I'm missing to complete a certain task. |
| US015 | Input Placeholders          | Medium | As a User, I want to see input placeholders, so that I understand what's expected of me when filling in forms. |
| US016 | View Seller Rating          | Medium | As a User, I want to view the rating of the seller, so that I can know if he is reliable. |
| US11 | Sign In                      | High | As an Unauthenticated User, I want to sign in, so that I can access privileged information. |
| US12 | Sign Up                      | High | As an Unauthenticated User, I want to sign up, so that I can authenticate myself into the system. |
| US21 | Sign Out                     | High | As an Authenticated User, I want to sign out, so that I can close my session. |
| US22 | Edit Profile                 | High | As an Authenticated User, I want to edit my account, so that I can update my information. |
| US23 | Bid on Auction               | High | As an Authenticated User, I want to bid on an auction, so that I acquire the product I desire. |
| US24 | Create Auction               | High | As an Authenticated User, I want to create an auction, so that I can sell my product. |
| US26 | Support Profile Picture      | Medium | As an Authenticated User, I want to have support for profile pictures, so that I can show others my appearance. |
| US29 | View Bidding History         | Medium | As an Authenticated User, I want to view my bidding history, so that I can keep track of the money I'm possibly spending. |
| US210 | Add Credit to Account       | Medium | As an Authenticated User, I want to add credit to my account, so that I have to balance to bid on the auctions. |
| US212 | Put a New Bid on Auction    | Medium | As an Authenticated User, I want to put a new bid on an auction, so that I have a chance at winning a product I desire. |
| US213 | Confirm Bid Popup           | Medium | As an Authenticated User, I want to see a confirmation popup when I try to place a bid, so that I don't make any mistakes. |
| US31 | View Auction Bidding History | High | As a Bidder, I want to view an auction's bidding history, so that I can keep track of the demand of the product. |
| US41 | View My Auctions             | High | As an Auction Owner, I want to view my auctions, so that I know which products I sold and which ones I'm selling. |
| US42 | Edit Auction                 | High | As an Auction Owner, I want to edit an auction, so that I can update its information and status. |
| US43 | Cancel Auction               | High | As an Auction Owner, I want to cancel my auction, so that I don’t have to sell the product anymore. |
| US51 | Manage Accounts              | High | As a System Manager, I want to manage the various user accounts, so that I can search, view, edit, create, etc, them. |
| US53 | Delete User Accounts         | Medium | As a System Manager, I want to delete a user account, so that they no longer have access to the website's authenticated features. |
| US54 | Manage Auctions              | Medium | As a System Manager, I want to manage an auction, so that I make sure everything is working properly. |
| US58 | User Search                  | Low | As a System Manager, I want to search for users, so that I can quickly find them. |


#### 1.2. Implemented Web Resources

> Module M01: Authentication and Individual Profile

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R101: Login Form | GET /login |
| R102: Login Action | POST /login |
| R103: Register Form | GET /register |
| R104: Register Action | POST /register |
| R105: Logout Action | POST /logout |
| R106: View Profile | GET /profile/{username} |
| R107: Edit Profile Form | GET /profile/{username}/mydetails |
| R108: Edit Profile Action | PUT /profile/{username}/mydetails |
| R109: Edit Password Form | GET /profile/{username}/mydetails |
| R110: Edit Password Action | PUT /profile/{username}/mypassword |
| R111: View Own Auctions | GET /profile/{username}/myauctions |
| R112: View Own Bids | GET /profile/{username}/mybids |
| R113: Add Balance Form | GET /profile/{username}/balance |
| R114: Add Balance Action | POST /profile/{username}/balance |

> Module M02: Auctions

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R201: Edit Auction Form | GET /auction/{id}/edit |
| R202: Edit Auction Action | PUT /auction/{id}/edit |
| R203: View Auction | GET /auction/{id} |
| R204: Create Auction Form | GET /auction/create |
| R205: Create Auction Action | POST /auction |
| R206: Delete Auction Action | DELETE /auction/{id} |


> Module M03: Bidding

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ | 
| R301: New Bid Form | GET /auction/{id} |
| R302: New Bid Action | POST auction/{id} |

> Module M04: Search Api And Search Pages

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ | 
| R401: User Search API (Admin) | GET /search/user/api |
| R402: Auction Search API (Admin) | GET /search/auction/api |
| R403: Auction Search API (User) | GET /search/api |
| R404: Auction Search Results Page | GET /search |
| R405: Auction Search by Category Results Page | GET /search/{category} |


> Module M05: User Administration and Static pages

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R501: View Admin Dashboard | GET /admin |
| R502: View All Registered Users | GET /admin/users |
| R503: View All Auctions | GET /admin/auctions |
| R504: View All Bids | GET /admin/bids |
| R505: Edit User Info Form | GET /profile/{username}/edit |
| R506: Edit User Info Action | PUT /profile/{username}/mydetails |
| R507: Create User Form | GET /admin/createuser |
| R508: Create User Action | POST /admin/createuser |
| R509: Delete User Action | DELETE /admin/users/{id} |
| R510: Delete Auction Action | DELETE /auction/{id} |


### 2. Prototype

[Prototype URL](https://lbaw2225.lbaw.fe.up.pt/) 

Credentials
  - Admin user: admin@gmail.com/1234
  - Regular user: cminister1@gmail.com/1234

[Prototype source code](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225)


---


## Revision history

Changes made to the first submission:


***
GROUP2225, 21/11/2022
 
* Diogo Babo, [up202004950@edu.fe.up.pt](mailto:up202004950@edu.fe.up.pt)
* João Oliveira, [up202004407@edu.fe.up.pt](mailto:up202004407@edu.fe.up.pt)
* Gustavo Costa, [up202004187@edu.fe.up.pt](mailto:up202004187@edu.fe.up.pt) (editor)
* Ricardo Cavalheiro, [up202005103@edu.fe.up.pt](mailto:up202005103@edu.fe.up.pt)

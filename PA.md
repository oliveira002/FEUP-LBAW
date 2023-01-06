# PA: Product and Presentation

WeBid is a platform that facilitates bidding and selling between buyers and sellers. We aspire to create an intuitive user interface that makes it simple for users to list items, place bids, and complete transactions. To enhance the auction experience, we'll offer features such as the ability to easily search and browse auctions by price, category, name and also schedule auctions in advance. Additionally, we prioritize the safety and security of our users by implementing robust fraud prevention measures and by having active system managers that will solve any issue an user might have. Our ultimate goal is to create a trusted and reliable marketplace that connects buyers from around the world.

## A9: Product

WeBid is an auction online platform where users can buy and sell items and services through an auction process. The website allows users to create an account, list items for sale, and place bids on items they are interested in purchasing. Listing an item up for auction involves setting a starting bid and a time limit, during which other users can place higher bids. When the auction ends, the highest bidder wins the auction and consequently the item.

### 1. Installation

Source code: https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/tree/PA

Command to run:
```docker run -it -p 8000:80 --name=lbaw2225 -e DB_DATABASE="lbaw2225" -e DB_SCHEMA="lbaw2225" -e DB_USERNAME="lbaw2225" -e DB_PASSWORD="MfabfwyW" git.fe.up.pt:5050/lbaw/lbaw2223/lbaw2225```

### 2. Usage

http://lbaw2225.lbaw.fe.up.pt  

#### 2.1. Administration Credentials

> Administration URL: http://lbaw2225.lbaw.fe.up.pt/admin  

| Email | Password |
| -------- | -------- |
| admin@gmail.com    | 1234 |

#### 2.2. User Credentials

| Type          | Email  | Password |
| ------------- | --------- | -------- |
| basic account | cminister1@gmail.com   | 1234 |

### 3. Application Help

The application's design is intuitive and the main CRUD actions are straightforward for the users. Despite this, we implemented ways to use the users experience. Many icons have a label associated to them so it's easier for the users to understand their functionality. Each form has its inputs fields filled with placeholders to better guide the user around correct input. 
When a user tries to do an action that he doesn't have permissions for an error message is shown, so that he knows what he did wrong. For example, when a costumer tries to put a bid below the current price or bid on his own auction or when an admin tries to delete an active auction (meaning there are bids in it) or when he tries to report/review a user.

<img src = "https://media.discordapp.net/attachments/784004838399672340/1059914135271383161/image.png">
 

### 4. Input Validation

#### 4.1 Client-Side Validation
The validation on the client-side was meant to provide intuitive feedback to the user about the quality and adequacy of the inserted the data. Once before submitting data to the server, it is always important to ensure all required form controls are filled out, in the correct format.

```php
<div class="form-outline mb-4">
    <input type="text" name="username" id="name" class="form-control form-control-lg" value="{{ old('username') }}" required autofocus maxlength="30"/>
     <label class="form-label" for="name">Username</label>
     @if ($errors->has('username'))
            <div class="alert alert-danger mb-1.5 mt-1.5">
                   <ul>
                        <li>{{ $errors->first('username') }}</li>
                   </ul>
            </div>
      @endif
</div>
```

#### 4.2 Server-Side Validation
When registering a new account, we check if the input given by the user follows the set of rules defined for each user attribute. For example, the password must have at least 8 characters, an uppercase, a lowercase, 1 digit and a special character.
```php 
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:30|unique:user',
            'email' => 'required|string|email|max:50|unique:user|unique:systemmanager',
            'firstname' => 'required|string|max:30|alpha_dash',
            'lastname' => 'required|string|max:30|alpha_dash',
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'
            ]
        ]);
    }
```

### 5. Check Accessibility and Usability
- [Accessibility](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/acessibilidade.pdf): 15/18 
- [Usability](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/usabilidade.pdf): 23/28  

### 6. HTML & CSS Validation

## HTML
- [Home](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/home.pdf)
- [About](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/about.pdf)
- [FAQ](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/faq.pdf)
- [Contact](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/contact.pdf)
- [Register](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/register.pdf)
- [Login](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/login.pdf)
- [Recover Password](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/recover.pdf)
- [Auction](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/auction.pdf)
- [Profile](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/profile.pdf)
- [Admin](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/admin.pdf)
- [Search](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/search.pdf)
- [Admin Manage](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/adminCostumers.pdf)
- [Edit Profile](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/useredit.pdf)

## CSS
- [Home](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/cssHome.pdf)
- [About](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/cssAbout.pdf)
- [Admin](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/cssAdmin.pdf)
- [Search](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/cssSearch.pdf)
- [Responsive](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/cssResponsive.pdf)
- [Profile](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/cssProfile.pdf)
- [Def](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/cssDef.pdf)
- [Auth](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/cssAuth.pdf)
- [Auction](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/report/cssAuction.pdf)

### 7. Revisions to the Project

Not many changes were made since the requirements specification, but the ones made were: create a new BanAppeals, Migrations & Password_Resets Table and added remember token to the User Table. 

### 8. Web Resources Specification
#### 8.1. [Open Api - Repository File](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2225/-/blob/main/a7_openapi.yaml)
```yaml
openapi: 3.0.0

info:
  version: '1.0'
  title: 'WeBid'
  description: 'Web Resources Specification (A7) for WeBid'

servers:
- url: http://lbaw.fe.up.pt
  description: Production server

externalDocs:
  description: Find more info here.
  url: https://web.fe.up.pt/~ssn/wiki/teach/lbaw/medialib/a07

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
  /profile/{username}/myfavourites:
    get:
      operationId: 'R114'
      summary: 'R114: View User Favourites'
      description: 'Show the User favourites. Access: USR, ADM'
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
          description: 'OK. Show Favourites page UI'        
  /profile/{username}/mywins:
    get:
      operationId: 'R115'
      summary: 'R115: View User Wins'
      description: 'Show the User wins. Access: USR, ADM'
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
          description: 'OK. Show Wins page UI'
  /forgot-password:
    get:
      operationId: 'R116'
      summary: 'R116: Forgot Password'
      description: 'Show the Forgot Password form. Access: PUB'
      tags:
        - 'M01: Authentication and Individual Profile'
      responses:
        '200':
          description: 'OK. Show Forgot Password form UI'
    post:
      operationId: 'R117'
      summary: 'R117: Forgot Password'
      description: 'Process the Forgot Password form. Access: PUB'
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
              required:
                - email
      responses:
        '302':
          description: 'Redirect after processing Forgot Password form.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful Forgot Password. Redirect to Login page.'
                  value: '/login'
                302Error:
                  description: 'Failed Forgot Password. Redirect to Forgot Password form.'
                  value: '/forgot-password'
  /reset-password/{token}:
    get:
      operationId: 'R118'
      summary: 'R118: Reset Password'
      description: 'Show the Reset Password form. Access: PUB'
      tags:
        - 'M01: Authentication and Individual Profile'
      parameters:
        - in: path
          name: token
          description: 'Token of the user to reset the password.'
          required: true
          schema:
            type: string
      responses:
        '200':
          description: 'OK. Show Reset Password form UI'
    post:
      operationId: 'R119'
      summary: 'R119: Reset Password'
      description: 'Process the Reset Password form. Access: PUB'
      tags:
        - 'M01: Authentication and Individual Profile'
      parameters:
        - in: path
          name: token
          description: 'Token of the user to reset the password.'
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
                password2:
                  type: string
              required:
                - password
                - password2
      responses:
        '302':
          description: 'Redirect after processing Reset Password form.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful Reset Password. Redirect to Login page.'
                  value: '/login'
                302Error:
                  description: 'Failed Reset Password. Redirect to Reset Password form.'
                  value: '/reset-password/{token}'
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
  /readnotification:
    post:
      operationId: 'R207'
      summary: 'R207: Read Notification Action'
      description: 'Process read Notification form. Access: USR, ADM'
      tags:
        - 'M02: Auctions'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                idnotification:
                  type: number
              required:
                - idnotification
      responses:
        '302':
          description: 'Notification Form.'
          headers:
            Location:
              schema:
                type: string

        '403':
          description: 'Forbidden.'
  /profile/{id}/createReview:
    post:
      operationId: 'R208'
      summary: 'R208: Create Review Action'
      description: 'Process create Review form. Access: USR, ADM'
      tags:
        - 'M02: Auctions'
      parameters:
        - in: path
          name: id
          description: 'ID of the user to show.'
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
                iduser:
                  type: number
                idauction:
                  type: number
                rating:
                  type: number
                comment:
                  type: string
              required:
                - iduser
                - idauction
                - rating
                - comment
      responses:
        '302':
          description: 'Redirect after processing Review Form.'
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
  /profile/{id}/createReport:
    post:
      operationId: 'R209'
      summary: 'R209: Create Report Action'
      description: 'Process create Report form. Access: USR, ADM'
      tags:
        - 'M02: Auctions'
      parameters:
        - in: path
          name: id
          description: 'ID of the user to show.'
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
                iduser:
                  type: number
                idauction:
                  type: number
                reason:
                  type: string
              required:
                - iduser
                - idauction
                - reason
      responses:
        '302':
          description: 'Redirect after processing Report Form.'
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
  /auction/{id}/createReport:
    post:
      operationId: 'R210'
      summary: 'R210: Create Report Action'
      description: 'Process create Report form. Access: USR, ADM'
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
                iduser:
                  type: number
                idauction:
                  type: number
                reason:
                  type: string
              required:
                - iduser
                - idauction
                - reason
      responses:
        '302':
          description: 'Redirect after processing Report Form.'
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
  /auction/{id}/favorite:
    post:
      operationId: 'R211'
      summary: 'R211: Favorite Auction Action'
      description: 'Process favorite Auction form. Access: USR, ADM'
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
                iduser:
                  type: number
                idauction:
                  type: number
              required:
                - iduser
                - idauction
      responses:
        '302':
          description: 'Redirect after processing Favorite Auction Form.'
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
  /AboutUs:
    get:
      operationId: 'R508'
      summary: 'R508: View About Page'
      description: 'View the About Page. Access: PUB'
      tags:
        - 'M05: User Administration and Static pages'
      responses:
        '200':
          description: 'Ok. Show'

  /ContactUs:
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
  /admin/logs:
    get:
      operationId: 'R511'
      summary: 'R511: View Logs Page'
      description: 'View the Logs Page. Access: ADM'
      tags:
        - 'M05: User Administration and Static pages'
      responses:
        '200':
          description: 'Ok. Show'
        '403':
          description: 'Forbidden. User is not an admin.'
  /admin/sellerreports:
    get:
      operationId: 'R512'
      summary: 'R512: View Seller Reports Page'
      description: 'View the Seller Reports Page. Access: ADM'
      tags:
        - 'M05: User Administration and Static pages'
      responses:
        '200':
          description: 'Ok. Show'
        '403':
          description: 'Forbidden. User is not an admin.'
  /admin/auctionreports:
    get:
      operationId: 'R513'
      summary: 'R513: View Auction Reports Page'
      description: 'View the Auction Reports Page. Access: ADM'
      tags:
        - 'M05: User Administration and Static pages'
      responses:
        '200':
          description: 'Ok. Show'
        '403':
          description: 'Forbidden. User is not an admin.'
  /admin/sellerreports/{id}:
    put:
      operationId: 'R514'
      summary: 'R514: Update Seller Report Action'
      description: 'Update a Seller Report. Access: ADM'
      tags:
        - 'M05: User Administration and Static pages'
      parameters:
        - in: path
          name: id
          description: 'ID of the seller report.'
          required: true
          schema:
            type: number
      responses:
        '302':
          description: 'Redirect after processing Admin Report Form.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful Update. Redirect to Admin Seller Reports Page.'
                  value: '/admin/sellerreports'
                302Error:
                  description: 'Failed Update. Redirect to admin seller report details.'
                  value: '/admin/sellerreports'
        '403':
          description: 'Forbidden. User is not an admin.'
  /admin/auctionreports/{id}:
    put:
      operationId: 'R515'
      summary: 'R515: Update Auction Report Action'
      description: 'Update an Auction Report. Access: ADM'
      tags:
        - 'M05: User Administration and Static pages'
      parameters:
        - in: path
          name: id
          description: 'ID of the auction report.'
          required: true
          schema:
            type: number
      responses:
        '302':
          description: 'Redirect after processing Admin Report Form.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful Update. Redirect to Admin Auction Reports Page.'
                  value: '/admin/auctionreports'
                302Error:
                  description: 'Failed Update. Redirect to admin auction report details.'
                  value: '/admin/auctionreports'
        '403':
          description: 'Forbidden. User is not an admin.'
  /admin/banappeals:
    get:
      operationId: 'R516'
      summary: 'R516: View Ban Appeals Page'
      description: 'View the Ban Appeals Page. Access: ADM'
      tags:
        - 'M05: User Administration and Static pages'
      responses:
        '200':
          description: 'Ok. Show'
        '403':
          description: 'Forbidden. User is not an admin.'
  /admin/ban/{id}:
    put:
      operationId: 'R517'
      summary: 'R517: Update Ban Appeal Action'
      description: 'Update a Ban Appeal. Access: ADM'
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
          description: 'Redirect after processing Admin Ban Appeal Form.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful Update. Redirect to Admin Ban Appeals Page.'
                  value: '/admin/banappeals'
                302Error:
                  description: 'Failed Update. Redirect to admin ban appeal details.'
                  value: '/admin/banappeals'
        '403':
          description: 'Forbidden. User is not an admin.'
  /admin/unban/{id}/{idbanappeal}:
    put:
      operationId: 'R518'
      summary: 'R518: Update Unban Appeal Action'
      description: 'Update an Unban Appeal. Access: ADM'
      tags:
        - 'M05: User Administration and Static pages'
      parameters:
        - in: path
          name: id
          description: 'ID of the user appeal.'
          required: true
          schema:
            type: number
        - in: path
          name: idbanappeal
          description: 'ID of the ban appeal.'
          required: true
          schema:
            type: number
      responses:
        '302':
          description: 'Redirect after processing Admin Unban Appeal Form.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful Update. Redirect to Admin Ban Appeals Page.'
                  value: '/admin/banappeals'
                302Error:
                  description: 'Failed Update. Redirect to admin ban appeal details.'
                  value: '/admin/banappeals'
        '403':
          description: 'Forbidden. User is not an admin.'
  /admin/rejectAppeal/{id}:
    delete:
      operationId: 'R519'
      summary: 'R519: Reject Ban Appeal Action'
      description: 'Reject a Ban Appeal. Access: ADM'
      tags:
        - 'M05: User Administration and Static pages'
      parameters:
        - in: path
          name: id
          description: 'ID of the Ban Appeal.'
          required: true
          schema:
            type: number
      responses:
        '302':
          description: 'Redirect after processing Admin Ban Appeal Form.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful Update. Redirect to Admin Ban Appeals Page.'
                  value: '/admin/banappeals'
                302Error:
                  description: 'Failed Update. Redirect to admin ban appeal details.'
                  value: '/admin/banappeals'
        '403':
          description: 'Forbidden. User is not an admin.'
  /BanAppeal:
    get:
      operationId: 'R520'
      summary: 'R520: View Ban Appeal Page'
      description: 'View the Ban Appeal Page. Access: USR'
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

### 9. Implementation Details

#### 9.1. Libraries Used

The libraries we used were:

- [Bootstrap](https://getbootstrap.com/) - Used sometimes instead of CSS for quick element styling.
- [FontAwesome](https://fontawesome.com/) - For every icon in the website.

#### 9.2 User Stories
| US Identifier | Name | Module | Priority | Team Members | State |
| ------ | ------ | ------ | ------ | ------ | ------ |
| US01 | View Users Profile | Module 01 |High |  **João Oliveira** | 100% |
| US02 | Search Auctions | Module 04 | High | **Diogo Babo**, Ricardo Cavalheiro  | 100% |
| US03 | View Active Auctions | Module 02 | High | **Ricardo Cavalheiro** | 100% |
| US04 | View Own Profile | Module 01 | High | **João Oliveira** | 100% |
| US05 | View Home Page |Module 04 |High | **Diogo Babo**, João Oliveira | 100% |
| US06 | View Auction Info | Module 02 |High | **João Oliveira**| 100% |
| US07 | Sign In | Module 01 |High | **Ricardo Cavalheiro**   | 100% |
| US08 | Sign Up | Module 01 |High | **Gustavo Costa** | 100% |
| US09 | Sign Out | Module 01 |High | **Gustavo Costa**   | 100% |
| US10 | Edit Profile | Module 01 |High | **Diogo Babo**, Gustavo Costa | 100% |
| US11 | Bid on Auction | Module 03 |High | **Ricardo Cavalheiro** | 100% |
| US12 | Create Auction | Module 02 |High | **Gustavo Costa** | 100% |
| US13 | View Auction Bidding History | Module 03 | High | **Ricardo Cavalheiro** | 100% |
| US14 | View My Auctions | Module 02 |High | **João Oliveira**  | 100% |
| US15 | Edit Auction | Module 02 |High | **João Oliveira** Diogo Babo | 100% |
| US16 | Cancel Auction | Module 02 | High | **Gustavo Costa**  | 100% |
| US17 | Manage Accounts | Module 05 |High | **Diogo Babo** Gustavo Costa | 100% |
| US18 | Password Recovery | Module 01 |Medium | **Gustavo Costa**  | 100% |
| US19 | Browse Auctions by Category | Module 02 | Medium | **Diogo Babo** | 100% |
| US20 | Contextual Errors | All |Medium | **Diogo Babo**  | 100% |
| US21 | Contextual Help | All |Medium | **Diogo Babo**  | 100% |
| US22 | View About Us | Module 05 |Medium |  **Ricardo Cavalheiro**  | 100% |
| US23 | View Contacts | Module 05 |Medium | **João Oliveira** | 100% |
| US24 | View FAQ | Module 05 |Medium | **Gustavo Costa** | 100% |
| US25 | Filtered Search | Module 02 |Medium | **Diogo Babo**  | 100% |
| US26 | Multiple Attribute Search| Module 02 |Medium | **Diogo Babo**  | 100% |
| US27 | Input Placeholders | All |Medium | **Gustavo Costa**  | 100%|
| US28 | View Seller Rating | Module 01 |Medium | **João Oliveira**  | 100% |
| US29 | View Notifications | Module 06 | Medium | **João Oliveira**  | 100% |
| US30 | Support Profile Picture | Module 01 |Medium | **Ricardo Cavalheiro** | 100% |
| US31 | Follow Auction | Module 02 |Medium | **Ricardo Cavalheiro**  | 100% |
| US32 | View Followed Auctions |  Module 01 |Medium | **Ricardo Cavalheiro**  | 100% |
| US33 | View Bidding History | Module 01  | Medium | **Gustavo Costa** | 100% |
| US34 | Add Credit to Account | Module 01 |Medium | **Ricardo Cavalheiro**  | 100% |
| US35 | Delete Account | Module 01 |Medium | **Gustavo Costa** | 100% |
| US36 | Put a New Bid on Auction | Module 04 |Medium | **Ricardo Cavalheiro**   | 100% |
| US37 | Confirm Bid Popup | Module 04 |Medium | **João Oliveira** | 100% |
| US38 | Rate Seller | Module 06 |Medium | **Diogo Babo**  | 100% |
| US39 | Partaking Auction Won Notification | Module 06 |Medium | **Diogo Babo**   | 100% |
| US40 | Partaking Auction Ending Notification | Module 06 |Medium | **Diogo Babo**   | 100% |
| US41 | Partaking Auction Ended Notification | Module 06 |Medium | **João Oliveira**  | 100% |
| US42 | Partaking Auction Canceled Notification | Module 06 |Medium |  **João Oliveira** | 100% |
| US43 | Owned Auction Ending Notification | Module 06 |Medium | **Ricardo Cavalheiro**  | 100% |
| US44 | Owned Auction Ended Notification | Module 06 |Medium | **Gustavo Costa** | 100% |
| US45 | Owned Auction Canceled Notification | Module 06 |Medium | **Ricardo Cavalheiro**  | 100% |
| US46 | Block and Unblock Accounts | Module 05  |Medium | **Gustavo Costa**  | 100% |
| US47 | Delete User Accounts | Module 05 |Medium | **Gustavo Costa**  | 100% |
| US48 | Manage Auctions | Module 05 |Medium | **João Oliveira**  | 100% |
| US49 | Cancel Auctions | Module 05 |Medium | **Ricardo Cavalheiro**  | 100% |
| US50 | Ordering Results | Module 02 |Low | **Diogo Babo**  | 100% |
| US51 | Report Auction | Module 02 |Low | **João Oliveira**  | 100% |
| US52 | Appeal for Unblock | Module 01 |Low | **Gustavo Costa**  | 100% |
| US53 | Manage Auction Reports | Module 05 |Low | **Ricardo Cavalheiro** | 100% |
| US54 | User Search | Module 05 |Low | **Diogo Babo**  | 100% |
| US55 | See Blocked User List | Module 05 |Low | **Ricardo Cavalheiro**  | 100% |
| US56 | See Active Reports | Module 05 |Low | **João Oliveira**  | 100% |
| US57 | See Closed Reports | Module 05 |Low | **João Oliveira**  | 100% |
| US58 | Change Report Status | Module 05 |Low | **Diogo Babo**  | 100% |


---


## A10: Presentation

### 1. Product presentation

WeBid is an online auction platform where users can buy and sell items and services. The website allows users to create an account, list items for sale, and place bids on items they are interested in purchasing. Listing an item up for auction involves setting a starting bid and a time limit, during which other users can place higher bids. When the auction ends, the highest bidder wins the auction and acquires the item.

Users have different ways of searching and browsing the different auctions, they can follow certain auctions they have interest in and there is a notification system to alert users of when they get outbid or when they win an auction. In order to make sellers trustworthy there is a review/report system that affects their own rating as well as an admin dashboard to ease system managers job when moderating the website.


**Website URL:** http://lbaw2225.lbaw.fe.up.pt  


### 2. Video presentation


---


## Revision history

***
GROUP2225, 03/01/2023

* Diogo Babo, [up202004950@edu.fe.up.pt](mailto:up202004950@edu.fe.up.pt)
* João Oliveira, [up202004407@edu.fe.up.pt](mailto:up202004407@edu.fe.up.pt)
* Gustavo Costa, [up202004187@edu.fe.up.pt](mailto:up202004187@edu.fe.up.pt) (Editor)
* Ricardo Cavalheiro, [up202005103@edu.fe.up.pt](mailto:up202005103@edu.fe.up.pt)

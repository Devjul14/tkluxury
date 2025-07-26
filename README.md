<<<<<<< HEAD
# TK Luxury - Student Accommodation Platform

A comprehensive Laravel Filament-based platform for managing student accommodation properties, bookings, payments, and maintenance requests.

## 🏗️ Project Overview

TK Luxury is a complete student accommodation management system designed to streamline the process of managing student housing properties. The platform provides comprehensive tools for property management, booking administration, payment processing, and maintenance coordination.

## ✨ Features

### Core Functionality
- **Property Management**: Complete CRUD operations for student accommodation properties
- **Institute Management**: Partner university and college management
- **Booking System**: End-to-end booking workflow from application to check-out
- **Payment Processing**: Integrated payment management with multiple payment methods
- **Contract Management**: Digital contract generation and signing
- **Maintenance Requests**: Work order system for property maintenance
- **Review System**: Student feedback and rating system
- **Staff Management**: Role-based access control for different staff types

### Admin Panel Features
- **Dashboard Analytics**: Real-time occupancy rates, revenue tracking, and maintenance overview
- **Property Portfolio Management**: Complete oversight of all properties
- **Booking Pipeline Management**: Application review and approval workflow
- **Financial Reporting**: Revenue tracking and expense management
- **Maintenance Coordination**: Work order assignment and tracking
- **Student Profile Management**: Comprehensive student information management

## 🛠️ Technology Stack

- **Backend**: Laravel 10.x
- **Admin Panel**: Filament 3.x
- **Database**: MySQL
- **Frontend**: Blade templates with Alpine.js and Tailwind CSS
- **Authentication**: Laravel's built-in authentication with role-based access

## 📋 Requirements

- PHP 8.1 or higher
- MySQL 8.0 or higher
- Composer
- Node.js and NPM (for asset compilation)

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone git@bitbucket.org:itsassef/tkluxury.git
   cd tkluxury
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   Update your `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=db_tk_lux
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Create admin user**
   ```bash
   php artisan make:filament-user
   ```

8. **Compile assets**
   ```bash
   npm run build
   ```

9. **Start the development server**
   ```bash
   php artisan serve
   ```

## 🗄️ Database Schema

### Core Models

#### Users
- Student, admin, and staff user types
- Profile information and contact details
- Role-based access control

#### Institutes
- Partner universities and colleges
- Location and contact information
- Partnership status tracking

#### Properties
- Accommodation details and specifications
- Pricing and availability information
- Property features and amenities
- Location and distance to campus

#### Bookings
- Student accommodation bookings
- Check-in/check-out management
- Payment and contract integration

#### Payments
- Multiple payment types (rent, deposit, fees)
- Payment status tracking
- Integration with payment gateways

#### Maintenance Requests
- Work order management
- Priority and status tracking
- Cost estimation and tracking

## 🎯 User Roles

### Admin
- Full system access
- User management
- System configuration
- Financial oversight

### Staff
- **Property Manager**: Property operations and tenant relations
- **Maintenance**: Work order management and property inspections
- **Customer Service**: Student support and communication
- **Finance**: Payment processing and financial reporting

### Student
- Property search and booking
- Payment management
- Maintenance request submission
- Review and feedback

## 📊 Dashboard Widgets

- **Occupancy Rate Widget**: Real-time property occupancy tracking
- **Revenue Widget**: Monthly and quarterly revenue analytics
- **Maintenance Widget**: Pending and urgent maintenance requests
- **Booking Pipeline Widget**: Application status tracking

## 🔧 Configuration

### Admin Panel Access
Access the admin panel at: `http://localhost/admin`

### Default Admin Credentials
- Email: `asifmailed@gmail.com`
- Password: (set during user creation)

## 📁 Project Structure

```
tkluxury/
├── app/
│   ├── Filament/           # Admin panel resources
│   ├── Models/            # Eloquent models
│   └── Providers/         # Service providers
├── database/
│   ├── migrations/        # Database migrations
│   └── seeders/          # Database seeders
├── resources/
│   └── views/            # Blade templates
└── public/               # Public assets
```

## 🚀 Deployment

### Production Setup
1. Set up a production server with PHP 8.1+
2. Configure MySQL database
3. Set up web server (Apache/Nginx)
4. Configure environment variables
5. Run migrations and seeders
6. Set up SSL certificate
7. Configure file storage (AWS S3 recommended)

### Environment Variables
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_DATABASE=your-db-name
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password

MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_USERNAME=your-smtp-user
MAIL_PASSWORD=your-smtp-password
```

## 🔒 Security Features

- Role-based access control
- CSRF protection
- SQL injection prevention
- XSS protection
- Secure file uploads
- Password hashing

## 📈 Future Enhancements

### Phase 2 Features
- Mobile application (React Native/Flutter)
- Advanced search and filtering
- Virtual property tours
- Automated payment processing
- Email and SMS notifications
- Advanced analytics and reporting

### Phase 3 Features
- AI-powered property recommendations
- Dynamic pricing algorithms
- Integration with university systems
- Advanced maintenance scheduling
- Student community features

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📄 License

This project is proprietary software developed for TK Luxury.

## 📞 Support

For support and inquiries:
- Email: asifmailed@gmail.com
- Repository: https://bitbucket.org/itsassef/tkluxury

## 🎉 Acknowledgments

- Laravel team for the amazing framework
- Filament team for the excellent admin panel
- All contributors and stakeholders

---

**TK Luxury Student Accommodation Platform** - Making student housing management simple and efficient.
=======
# README #

This README would normally document whatever steps are necessary to get your application up and running.

### What is this repository for? ###

* Quick summary
* Version
* [Learn Markdown](https://bitbucket.org/tutorials/markdowndemo)

### How do I get set up? ###

* Summary of set up
* Configuration
* Dependencies
* Database configuration
* How to run tests
* Deployment instructions

### Contribution guidelines ###

* Writing tests
* Code review
* Other guidelines

### Who do I talk to? ###

* Repo owner or admin
* Other community or team contact
>>>>>>> 9fab28fa00c6fb3e13c5258840bda37194a05383

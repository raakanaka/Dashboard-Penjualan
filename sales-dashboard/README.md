# Sales Dashboard - Laravel Application

A comprehensive sales management system built with Laravel framework featuring dashboard analytics, inventory management, sales tracking, and reporting capabilities.

## 🚀 Features

### Dashboard
- **Real-time Analytics**: View total sales, today's sales, product count, and customer statistics
- **Sales Charts**: Interactive charts showing sales trends over the last 7 days
- **Quick Stats**: Overview of total transactions, suppliers, and low stock alerts
- **Recent Activity**: Latest sales and purchases with status indicators
- **Low Stock Alerts**: Automatic notifications for products running low on stock

### Product Management
- **Product Catalog**: Complete product management with images, SKU, and pricing
- **Category Management**: Organize products by categories
- **Stock Tracking**: Monitor current stock levels and set minimum stock alerts
- **Image Upload**: Support for product images with preview functionality

### Sales Management
- **Sales Transactions**: Create and manage sales orders
- **Customer Management**: Maintain customer database with contact information
- **Invoice Generation**: Generate professional invoices for sales
- **Payment Tracking**: Track different payment methods and transaction status

### Purchase Management
- **Purchase Orders**: Create and manage purchase orders from suppliers
- **Supplier Management**: Maintain supplier database with contact details
- **Inventory Updates**: Automatic stock updates when purchases are completed

### Inventory Management
- **Stock Tracking**: Real-time inventory levels across all products
- **Stock Alerts**: Automatic notifications for low stock items
- **Inventory History**: Track stock movements and adjustments
- **Warehouse Management**: Monitor stock levels and reorder points

### Reporting
- **Sales Reports**: Detailed sales analysis and trends
- **Purchase Reports**: Supplier purchase history and analysis
- **Inventory Reports**: Stock level reports and movement history
- **Export Capabilities**: Export reports in various formats

## 🛠️ Technology Stack

- **Backend**: Laravel 12.x (PHP 8.3+)
- **Database**: SQLite (Development) / MySQL/PostgreSQL (Production)
- **Frontend**: Bootstrap 5, Chart.js, Font Awesome
- **Additional**: jQuery, AJAX for dynamic interactions

## 📋 Requirements

- PHP 8.3 or higher
- Composer
- SQLite (for development)
- Web server (Apache/Nginx)

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd sales-dashboard
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   ```bash
   # For SQLite (Development)
   touch database/database.sqlite
   # Update .env file with SQLite configuration
   ```

5. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Create storage link**
   ```bash
   php artisan storage:link
   ```

7. **Start development server**
   ```bash
   php artisan serve
   ```

8. **Access the application**
   ```
   http://localhost:8000
   ```

## 📊 Database Structure

### Core Tables
- **users**: User authentication and profiles
- **categories**: Product categories
- **products**: Product catalog with pricing and stock
- **customers**: Customer information
- **suppliers**: Supplier information
- **sales**: Sales transactions
- **sale_items**: Individual items in sales
- **purchases**: Purchase transactions
- **purchase_items**: Individual items in purchases
- **inventory**: Stock movement tracking

## 🎯 Usage Guide

### Dashboard
- Access the main dashboard at `/dashboard`
- View real-time statistics and charts
- Monitor low stock alerts
- Check recent sales and purchases

### Product Management
- Navigate to **Products** in the sidebar
- Add new products with images and pricing
- Set minimum stock levels for alerts
- Manage product categories

### Sales Management
- Create new sales transactions
- Select customers and products
- Generate invoices
- Track payment status

### Inventory Management
- Monitor stock levels
- View low stock alerts
- Track inventory movements
- Manage reorder points

## 🔧 Configuration

### Environment Variables
Key configuration options in `.env`:

```env
APP_NAME="Sales Dashboard"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

### File Uploads
- Product images are stored in `public/images/products/`
- Maximum file size: 2MB
- Supported formats: JPEG, PNG, JPG, GIF

## 📈 Features in Detail

### Dashboard Analytics
- **Total Sales**: Cumulative sales amount
- **Today's Sales**: Sales amount for current day
- **Product Count**: Total active products
- **Customer Count**: Total registered customers
- **Sales Chart**: 7-day sales trend visualization
- **Top Products**: Best-selling products by quantity

### Stock Management
- **Real-time Tracking**: Live stock level monitoring
- **Low Stock Alerts**: Automatic notifications
- **Stock History**: Complete movement tracking
- **Reorder Points**: Configurable minimum stock levels

### Reporting System
- **Sales Reports**: Date range sales analysis
- **Purchase Reports**: Supplier purchase history
- **Inventory Reports**: Stock level and movement reports
- **Export Functionality**: PDF and Excel export options

## 🔒 Security Features

- **Input Validation**: Comprehensive form validation
- **SQL Injection Protection**: Laravel's built-in protection
- **XSS Protection**: Automatic output escaping
- **CSRF Protection**: Cross-site request forgery protection
- **File Upload Security**: Validated file uploads

## 🚀 Deployment

### Production Setup
1. Set `APP_ENV=production` in `.env`
2. Configure production database (MySQL/PostgreSQL)
3. Set up web server (Apache/Nginx)
4. Configure SSL certificate
5. Set up backup procedures

### Performance Optimization
- Enable Laravel caching
- Optimize database queries
- Use CDN for static assets
- Implement image optimization

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📝 License

This project is licensed under the MIT License.

## 🆘 Support

For support and questions:
- Create an issue in the repository
- Contact the development team
- Check the documentation

## 🔄 Updates

### Version 1.0.0
- Initial release with core features
- Dashboard analytics
- Product management
- Sales and purchase tracking
- Inventory management
- Basic reporting

### Planned Features
- Advanced reporting with charts
- Multi-warehouse support
- Barcode scanning
- Mobile application
- API endpoints
- Advanced user roles and permissions

---

**Sales Dashboard** - Empowering businesses with comprehensive sales and inventory management solutions.

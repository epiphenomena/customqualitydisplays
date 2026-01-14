# Implementation Guide: Converting Static Website to Data-Driven CMS

## Objective
Transform a static single-page website into a data-driven content management system where content is stored in JSON and markdown files and can be edited through an admin interface.

## Initial State
- Single-page application with `index.php` containing all content sections
- Static content hardcoded in HTML
- Header and footer include files
- Settings already configurable via `data/settings.json` and `admin/settings/index.php`

## Required Sections to Convert

### 1. Hero Section (Implemented)
- **Data File**: `data/hero.md`
- **Admin Page**: `admin/hero/index.php`
- **Implementation**: Convert hero HTML to markdown content
- **Markdown Processing**: Use Parsedown to convert to HTML
- **Special Handling**: Add `.btn` class to the last link in the hero section via JavaScript in `script.js`

### 2. Values Section (Implemented)
- **Data File**: `data/values.json`
- **Admin Page**: `admin/values/index.php`
- **Content**: Single markdown field for all content, with title and subtitle as separate fields
- **Image Handling**: Image upload functionality with file cleanup
- **Special Handling**: Use Parsedown for markdown processing

### 3. Portfolio Section (Implemented)
- **Data File**: `data/portfolio.json`
- **Admin Page**: `admin/portfolio/index.php`
- **Content Structure**:
  ```json
  {
    "title": "Our Work",
    "items": [
      {
        "title": "Project Title",
        "description": "Brief description",
        "full_description": "Full description",
        "image_url": "/media/portfolio-image.jpg"
      }
    ]
  }
  ```
- **Admin Features**:
  - Add/edit/delete functionality for portfolio items
  - Image upload for each portfolio item
  - Move up/down buttons to reorder items
  - Image cleanup when items are deleted
- **Frontend Display**: Maintain existing structure and functionality

### 4. Contact Section (No Changes Needed)
- Information already in `data/settings.json` and used in footer
- No separate data file or admin page needed

## Technical Implementation Requirements

### Data Storage
- Store all content in the `/data/` directory
- Use JSON files for structured data with multiple properties
- Use markdown files for text content that benefits from markdown formatting
- Maintain existing Parsedown library for markdown processing

### Admin Interface
- Create admin pages under `/admin/section-name/` subdirectories
- Use existing admin header/footer structure
- Include image upload functionality using existing `image_utils.php`
- Implement proper image cleanup when content is deleted
- Add reorder functionality for portfolio with move up/down buttons

### Image Management
- Store all images in `/media/` directory
- Generate clear filenames based on content titles
- Implement file cleanup when content items are deleted
- Use existing image utility functions for upload and removal

### User Interface
- Display edit forms to the right of item lists using flex layout
- Add "Move Up" and "Move Down" buttons for reordering (when applicable)
- Maintain existing styling and CSS classes
- Provide markdown formatting guidance in admin interface

### Security and Access
- Assume admin access is protected by HTTP BasicAuth
- Skip validation and XSS prevention as admin access is restricted
- Assume all admin input is safe

### Admin Dashboard
- Update `admin/index.php` to include links to all content management sections
- Create card-style interface for each management section
- Maintain consistent styling with existing dashboard

## Implementation Order
1. Portfolio section (most complex)
2. Values section 
3. Hero section
4. Update admin dashboard
5. Add reorder functionality to portfolio
6. Convert values section to markdown
7. Position admin forms to the right of item lists

## Testing Requirements
- Verify all content displays correctly after conversion
- Ensure admin forms save and retrieve data properly
- Test image upload and cleanup functionality
- Verify reorder functionality works for portfolio
- Confirm contact information continues to pull from settings.json
- Ensure no content is lost during the conversion process

## Special Considerations
- Portfolio section needs reordering functionality
- Image files must be properly cleaned up when content items are deleted
- The hero section link needs the `.btn` class added via JavaScript
- The values section uses markdown for flexible content formatting
- Maintain backward compatibility with existing CSS and JavaScript functionality
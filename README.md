# CSV to File Converter for Day One Journal Exports

A PHP script that converts CSV exports from Day One journal app into individual text files with proper formatting and metadata.

## Overview

This tool processes CSV files exported from Day One journal entries and creates individual text files for each journal entry. It's designed to handle German text with proper umlaut normalization and creates clean, readable filenames.

## Features

- **CSV Processing**: Reads Day One CSV exports line by line
- **Date Extraction**: Extracts and formats dates from timestamps (YYYY-MM-DD)
- **German Umlaut Support**: Normalizes German characters (ä→ae, ö→oe, ü→ue, ß→ss)
- **Word Boundary Respect**: Ensures filenames end with complete words
- **YAML Front Matter**: Adds metadata to each file with the entry date
- **Clean Filenames**: Creates readable filenames with spaces and proper separators
- **Subdirectory Organization**: Organizes files in a `output/` folder

## File Structure

### Input
- `input.csv` - Day One CSV export file
- CSV format: `date;text;uuid;modifiedDate;timeZoneIdentifier`

### Output
- `output/` directory containing individual `.txt` files
- Filename format: `YYYY-MM-DD - descriptive text.txt`
- Each file contains YAML front matter with the date

## Usage

1. Place your Day One CSV export file in the same directory as the script
2. Run the script:
   ```bash
   php export-cli.php
   ```
3. Files will be created in the `output/` subdirectory

## File Format Example

**Filename:**
```
2024-01-15 - lorem ipsum dolor sit amet.txt
```

**Content:**
```yaml
---
date: 2024-01-15
---

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
```

## Features in Detail

### Date Formatting
- Extracts date from ISO timestamp format
- Formats as YYYY-MM-DD for consistency

### Filename Generation
- Takes first 30 characters from journal entry text
- Respects word boundaries (no broken words)
- Normalizes German umlauts for compatibility
- Uses space-dash-space separator (` - `) between date and text
- Allows spaces in filenames for readability

### Text Processing
- Converts to lowercase for consistency
- Removes special characters except letters, numbers, spaces, and hyphens
- Normalizes multiple spaces/hyphens to single spaces
- Trims leading/trailing whitespace

### Metadata
- Adds YAML front matter to each file
- Includes the entry date for easy parsing
- Compatible with static site generators and note-taking apps

## Requirements

- PHP 7.0 or higher
- File system write permissions

## Output Statistics

The script processes all entries and provides:
- Total number of files created
- Progress feedback during processing
- Error handling for missing or invalid data

## Compatibility

The generated files are compatible with:
- Any system that supports YAML front matter

## File Organization

All extracted journal entries are organized in the `output/` subdirectory with clean, descriptive filenames that make it easy to browse and find specific entries.

## License

This script is provided as-is for personal use with Day One journal exports. 
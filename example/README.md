# Example Usage

This directory contains example files to demonstrate how the Day One CSV to File Exporter works.

## Files

- **`input.csv`** - Sample CSV file with 10 journal entries (mixed German/English content)
- **`export-cli.php`** - The exporter script (configured to use `input.csv`)
- **`output/`** - Directory containing the generated text files

## How to Test

1. **Run the exporter:**
   ```bash
   php export-cli.php
   ```

2. **Check the output:**
   ```bash
   ls -la output/
   ```

3. **View a sample file:**
   ```bash
   cat output/2024-01-16\ -\ heute\ war\ ein\ wunderschoener.txt
   ```

## Expected Output

The script will create 10 text files with:
- **Date formatting**: YYYY-MM-DD
- **German umlaut normalization**: ä→ae, ö→oe, ü→ue, ß→ss
- **Word boundary respect**: Complete words in filenames
- **YAML front matter**: Date metadata in each file
- **Space-dash-space separator**: ` - ` between date and text

## Sample Filenames

- `2024-01-15 - lorem ipsum dolor sit amet.txt`
- `2024-01-16 - heute war ein wunderschoener.txt`
- `2024-01-17 - meeting with the development.txt`
- `2024-01-18 - fruehstueck mit freunden im.txt`
- `2024-01-19 - working on the new website.txt`

## Sample File Content

Each file contains:
```
---
date: 2024-01-16
---

Heute war ein wunderschöner Tag im Park. Die Sonne schien und die Vögel sangen...
```

This example demonstrates all the features of the exporter with realistic content. 
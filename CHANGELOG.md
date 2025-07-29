# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2025-07-29

### Added
- Initial release of Day One CSV to file converter
- CSV processing with proper date extraction
- German umlaut normalization (ä→ae, ö→oe, ü→ue, ß→ss)
- Word boundary respect for clean filenames
- YAML front matter metadata with entry dates
- Space-dash-space separator in filenames
- Subdirectory organization (`journal_entries/`)
- Support for mixed language content (German/English)
- Clean, readable filename generation
- Error handling and progress feedback

### Features
- Processes Day One CSV export format
- Creates individual text files for each journal entry
- Maintains original text content with added metadata
- Compatible with static site generators and note-taking apps
- Handles special characters and formatting properly 
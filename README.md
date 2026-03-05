# Avada Chrome TinyMCE Fix

A lightweight WordPress plugin that fixes the phantom blank line appearing at the top of Avada Builder text and headline elements when editing in Chrome.

---

## The Problem

When editing text or headline elements in the Avada backend builder using Chrome, a blank line appears above your content. This does **not** appear in Firefox or Edge, and does **not** affect the frontend display — it is purely a backend editor visual bug.

**What's actually happening:**
- TinyMCE (the editor Avada uses) injects a cursor anchor element (`data-mce-type="bookmark"`) when initializing a `contenteditable` field
- Chrome uniquely appends a `<br>` tag after this bookmark span
- This `<br>` renders as a visible blank line above your content
- Toggling between Visual and Code view removes it temporarily, but it returns on every page load/refresh

---

## The Fix

On TinyMCE initialization, the plugin queries for any `<br>` tags immediately following a TinyMCE bookmark span and removes them before they render visually.

- ✅ Backend editor only — no effect on frontend
- ✅ Works on all Avada text and headline elements
- ✅ Compatible with Avada 7.x and Classic Editor
- ✅ No configuration needed — install and activate

---

## Installation

### Option A — Upload via WordPress Admin (recommended)
1. Download the latest `.zip` from the [Releases](../../releases) page
2. Go to **WordPress Dashboard → Plugins → Add New → Upload Plugin**
3. Upload the `.zip` file and click **Install Now**
4. Click **Activate Plugin**

### Option B — Manual via FTP
1. Download and unzip the plugin
2. Upload the `avada-chrome-tinymce-fix` folder to `/wp-content/plugins/`
3. Go to **WordPress Dashboard → Plugins** and activate it

---

## Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
- Avada Theme (any version using Classic Editor / TinyMCE)
- Affects Chrome browser only — Firefox and Edge are unaffected

---

## Compatibility

| Environment | Status |
|---|---|
| Avada 7.x | ✅ Tested |
| WordPress 6.x | ✅ Tested |
| Chrome (all versions) | ✅ Fixed |
| Firefox / Edge | ✅ Unaffected (no fix needed) |
| Classic Editor | ✅ Compatible |
| Gutenberg | ⚠️ Not tested (Avada uses its own builder) |

---

## FAQ

**Does this affect my frontend?**
No. The fix only runs inside the TinyMCE editor in the WordPress backend.

**Does this affect my content/data?**
No. The `<br>` being removed is injected by TinyMCE dynamically on load — it is never saved to your database.

**Will this work on multiple Avada sites?**
Yes — that's exactly what it's designed for. Install and activate on any Avada site running Chrome.

**Does removing the `<br>` affect accessibility?**
No. This is a TinyMCE internal cursor element, not part of your content.

---

## Changelog

### 1.0.0
- Initial release
- Fixes phantom blank line in Chrome for all Avada text and headline elements

---

## License

This plugin is licensed under the [GPL v2 or later](https://www.gnu.org/licenses/gpl-2.0.html).

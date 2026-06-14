# Tutorium Redesign - TODO

## Task 1: WhatsApp-style Chat Interface
- [ ] Rewrite `tutors/layouts/app.blade.php` to support full-page views (no padding/footer for chat, add floating mini-chat container)
- [ ] Rewrite `tutors/chat.blade.php` with WhatsApp-style full-screen layout
  - Left panel: w-80 contact sidebar with search bar, scrollable contact list (avatar, name, last message, unread badges)
  - Right panel: flex-1 flex-col with top bar, scrollable messages, bottom input with attachment+send
  - Custom hidden scrollbars
  - Mobile responsive: contact list collapses to drawer
- [ ] Add floating mini-chat widget to main tutor layout (Alpine.js-driven, bottom-right, persistent across pages)

## Task 2: Account & Subscription Management Hub
- [ ] Rewrite `tutors/subscription.blade.php` with tabbed "Account Settings" hub
  - Tab navigation: Profil Saya | Langganan & Billing | Keamanan / Sandi
  - "Profil Saya" tab - profile form (ported from profile.blade.php)
  - "Langganan & Billing" tab - subscription status banner + pricing tier cards
  - "Keamanan / Sandi" tab - password change form
- [ ] Subscription status banner with plan, renewal date, billing status
- [ ] Side-by-side pricing tier cards (Basic vs Premium) with modern SaaS UI
  - Highlighted premium card with accent border, badge, checkmark lists
  - CTA buttons: disabled "Aktif" for current plan, action button for upgrade

## Verification
- [ ] Verify no broken routes or layout issues
- [ ] Open a browser to verify visual output

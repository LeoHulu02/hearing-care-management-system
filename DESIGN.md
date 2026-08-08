# Hearing Care Design System

Portable design system for Open Design and Cursor-assisted UI work.

## Product

Hearing Care Order Management System is a web app for hearing aid product ordering. The product replaces manual ordering via chat or notes with a clear customer storefront and a structured admin dashboard.

Primary users:

- Customers browsing hearing aid products and creating orders.
- Admin staff managing products, customers, orders, and order statuses.

Core experience:

- Calm healthcare interface.
- Clear ordering steps.
- Fast product discovery.
- Trustworthy admin operations.

## Tech Context

- Backend: Laravel 12.
- Admin: Filament 4.
- Frontend: Blade templates with Vite.
- Styling: Tailwind CSS v4 using `@theme` tokens in `resources/css/app.css`.
- Customer layout: `resources/views/layouts/app.blade.php`.
- Admin theme: `resources/css/filament/admin/theme.css`.

Generated design artifacts should be translated back into Blade, Tailwind utility classes, Filament resources, or Filament widgets. Do not introduce a separate frontend framework unless explicitly requested.

## Visual Direction

The interface should feel medical, calm, modern, and practical. Prefer clarity over decoration. Use generous whitespace, readable labels, and card-based grouping.

Design keywords:

- Healthcare clarity.
- Calm teal accents.
- Structured order management.
- Mobile-first customer flows.
- Dense but readable admin tables.

Avoid:

- Overly playful visuals.
- Low-contrast gray text.
- Decorative animations that slow down task completion.
- Hardcoded colors outside the project tokens.

## Color Tokens

Use these tokens as the source of truth.

| Purpose | Token | Hex | Usage |
| --- | --- | --- | --- |
| Primary | `hc-primary` | `#0d9488` | CTA buttons, active navigation, links, prices |
| Sidebar | `hc-sidebar` | `#0f172a` | Admin sidebar and dark surfaces |
| Background | `hc-bg` | `#f8fafc` | Page background |
| Card | `hc-card` | `#ffffff` | Cards, panels, modal surfaces |
| Border | `hc-border` | `#e2e8f0` | Card borders, dividers, inputs |
| Text | `hc-text` | `#0f172a` | Main headings and body text |
| Muted | `hc-muted` | `#64748b` | Secondary text, helper text, placeholders |

Status colors:

| Status | Token | Hex |
| --- | --- | --- |
| Pending | `status-pending` | `#f59e0b` |
| Processing | `status-processing` | `#2563eb` |
| Completed | `status-completed` | `#16a34a` |
| Cancelled | `status-cancelled` | `#dc2626` |

## Typography

Use Instrument Sans or the existing sans-serif stack from Tailwind.

Text hierarchy:

- Page title: strong, tracking-tight, dark slate.
- Page subtitle: muted, concise, one sentence.
- Card title: semibold, compact.
- Body text: readable at small sizes.
- Labels: clear, explicit, never placeholder-only.
- Prices: bold teal.

## Spacing

Use an 8pt grid. Prefer Tailwind spacing based on `2`, `3`, `4`, `5`, `6`, `8`, and `10`.

Standard page shell:

- Max width: `max-w-6xl`.
- Horizontal padding: `px-4`.
- Vertical padding: `py-10 sm:py-12`.
- Card padding: `p-5 sm:p-6`.
- Section gap: `gap-6` or `gap-8`.

## Components

### Card

Use rounded cards with subtle border and shadow.

Tailwind source:

```css
.hc-card {
    @apply rounded-2xl border border-hc-border/60 bg-hc-card shadow-sm;
}
```

Use for product cards, order summaries, forms, detail panels, and dashboard sections.

### Button

Primary actions use pill buttons.

```css
.hc-button-primary {
    @apply rounded-full bg-hc-primary px-5 py-2.5 font-medium text-white transition-all hover:bg-teal-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2;
}
```

Rules:

- Primary CTA: teal pill button.
- Secondary action: white or slate button with border.
- Destructive action: rose tone, only for destructive operations.
- All interactive controls need visible focus states.

### Form

Use explicit labels, rounded inputs, helper text, and clear validation errors.

Input style:

```css
.hc-input {
    @apply w-full rounded-xl border border-hc-border bg-white px-4 py-2.5 text-sm text-hc-text placeholder:text-hc-muted transition focus:border-hc-primary focus:outline-none focus:ring-2 focus:ring-teal-500/20;
}
```

### Status Badge

Use the existing Blade component:

```blade
<x-status-badge :status="$order->status" />
```

Supported statuses:

- `pending`
- `processing`
- `completed`
- `cancelled`
- `in_stock`
- `out_of_stock`

### Product Card

Product cards should include:

- Product image or fallback HC mark.
- Product name.
- Stock badge.
- Short description.
- Price in Indonesian Rupiah.
- `View Detail` action.

Use the existing component:

```blade
<x-product-card :product="$product" />
```

## Customer Pages

Design and prototype these pages first:

- Home: product value proposition and clear login/register entry.
- Product list: searchable or scannable product cards.
- Product detail: product image, description, price, stock, order CTA.
- Create order: selected product, quantity, delivery/contact fields, confirmation summary.
- Order history: table or card list of customer orders.
- Order detail: order items, total, status timeline, customer info.
- Profile: editable customer profile fields.

Customer pages must be mobile-first.

## Admin Pages

Admin uses Filament 4. Design work should guide theme, resource layout, widgets, copy, and visual hierarchy.

Priority admin surfaces:

- Dashboard overview with order stats.
- Product resource list and form.
- Customer resource list and detail/edit view.
- Order resource list, filters, status badges, and status update flow.

Admin UI should stay close to Filament conventions. Do not design custom admin patterns that fight Filament defaults.

## Accessibility

Requirements:

- WCAG AA contrast for normal text.
- Visible focus rings.
- Labels on all inputs.
- Buttons and links must be keyboard reachable.
- Status should not rely only on color; include text labels.
- Empty states should explain the next action.

## Open Design Workflow

Use this file as the design system input when generating artifacts in Open Design.

Recommended first artifacts:

1. Customer product catalog screen.
2. Customer create order flow.
3. Customer order history/detail screens.
4. Admin dashboard concept.
5. Admin order management screen.

Recommended prompt:

```text
Create a production-ready UI concept for the Hearing Care Order Management System using the attached DESIGN.md system.

Target screen: [screen name]
Audience: [customer/admin]
Framework target: Laravel Blade + Tailwind CSS v4, or Filament 4 for admin.
Style: calm healthcare, teal and slate, card-based, accessible, mobile-first for customer pages.
Constraints: use the existing color tokens, rounded cards, pill CTAs, visible focus states, and status badge labels.
Output: layout direction, component breakdown, responsive behavior, and implementation notes for Laravel/Filament.
```

When converting an Open Design output into code, keep the existing Laravel route names, Blade components, Tailwind tokens, and Filament conventions.

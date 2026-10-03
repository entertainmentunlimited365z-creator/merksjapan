<?php
// Keep only verified customer-facing details here. Configure optional values in
// the hosting environment before displaying them publicly.
return [
  'brand_name' => 'Merks Apparel',
  'support_phone_display' => '1-833-674-2210',
  'support_phone_href' => 'tel:+18336742210',
  'support_email' => getenv('MERKS_SUPPORT_EMAIL') ?: 'support@merksapparel.online',
  'legal_name' => getenv('MERKS_LEGAL_NAME') ?: 'Merks Apparels LLC',
  'address' => getenv('MERKS_BUSINESS_ADDRESS') ?: '2329 Stonebridge Dr, Ste E, Flint, MI 48532',
  'hours' => getenv('MERKS_SUPPORT_HOURS') ?: '24/7',
];

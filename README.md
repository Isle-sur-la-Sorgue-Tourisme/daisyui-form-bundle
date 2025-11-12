[![ci](https://github.com/Isle-sur-la-Sorgue-Tourisme/daisyui-form-bundle/actions/workflows/ci.yml/badge.svg)](https://github.com/Isle-sur-la-Sorgue-Tourisme/daisyui-form-bundle/actions/workflows/ci.yml)
![SF Version](https://img.shields.io/badge/symfony-%3E%3D6.4-000?style=for-the-badge)
![PHP Version](https://img.shields.io/badge/php->=8.1-4f5b93.svg?style=for-the-badge)
![DaisyUi Version](https://img.shields.io/badge/daisyUi->=5.0-FFCE2A.svg?style=for-the-badge)


# [WIP] DaisyUI Form Bundle

A Symfony bundle that provides partial form theme for [DaisyUI](https://daisyui.com/) components.

## Features

- ✅ **Partial DaisyUI component support** - Form field types styled with DaisyUI classes
- 🎨 **Tailwind CSS integration** - Works seamlessly with Tailwind CSS utility classes
- 📱 **Responsive design** - Mobile-friendly form layouts out of the box
- ♿ **Accessible** - Maintains Symfony's accessibility features

## Supported Form Types

- Text inputs, textareas, and all standard HTML5 input types
- Select dropdowns (with autocomplete support)
- Checkboxes and radio buttons
- Date, time, and datetime pickers
- Money and percent inputs
- File uploads
- Submit and reset buttons
- And more...


## Installation

### 1. Install the bundle
```bash
composer require islesurlasorguetourisme/daisyui-form-bundle
```

### 2. Enable the bundle

If you're using Symfony Flex, the bundle is automatically enabled. Otherwise, add it to `config/bundles.php`:
```php
return [
    // ...
    Islesurlasorguetourisme\DaisyuiFormBundle\DaisyuiFormBundle::class => ['all' => true],
];
```

### 3. Configure the form theme

Add the form theme to your `config/packages/twig.yaml`:
```yaml
twig:
    form_themes:
        - '@DaisyuiForm/form/daisyui_layout.html.twig'
```

### 4. Ensure DaisyUI is installed

Make sure you have DaisyUI and Tailwind CSS properly configured in your project:
```bash
npm install -D daisyui@latest
```

**style.css**
```css
@import "tailwindcss";
@plugin "daisyui";
```

## Usage

Once installed and configured, all your Symfony forms will automatically use DaisyUI styling:
```php
// In your controller
$form = $this->createFormBuilder()
    ->add('name', TextType::class)
    ->add('email', EmailType::class)
    ->add('message', TextareaType::class)
    ->add('send', SubmitType::class)
    ->getForm();
```
```twig
{# In your template #}
{{ form(form) }}
```

That's it! Your form will be rendered with beautiful DaisyUI components.


### Per-form theme override

To use the DaisyUI theme for a specific form:
```twig
{% form_theme form '@DaisyuiForm/form/daisyui_layout.html.twig' %}
{{ form(form) }}
```

## Customization

### Override specific blocks

Create your own form theme file and extend the DaisyUI theme:
```twig
{% extends '@DaisyuiForm/form/daisyui_layout.html.twig' %}

{% block form_row %}
    {# Your custom form row markup #}
    {{ parent() }}
{% endblock %}
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This bundle is released under the MIT License. See the LICENSE file for details.

## Credits

- Developed and maintained by [Isle sur la Sorgue Tourisme](https://github.com/islesurlasorguetourisme)
- Built for [Symfony](https://symfony.com/)
- Styled with [DaisyUI](https://daisyui.com/)

## Support

If you encounter any issues or have questions:
- Open an issue on [GitHub](https://github.com/islesurlasorguetourisme/daisyui-form-bundle/issues)
- Check the [Symfony Form documentation](https://symfony.com/doc/current/forms.html)
- Refer to [DaisyUI documentation](https://daisyui.com/components/)

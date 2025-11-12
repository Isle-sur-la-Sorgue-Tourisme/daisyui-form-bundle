<?php

declare(strict_types=1);

namespace Islesurlasorguetourisme\DaisyuiFormBundle\Tests;

use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Test\FormLayoutTestCase;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormError;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Translator;

final class FormThemeTest extends FormLayoutTestCase
{
    protected function getTemplatePaths(): array
    {
        return [
            __DIR__ . '/../templates/form',
            __DIR__ . '/../vendor/symfony/twig-bridge/Resources/views/Form',
        ];
    }

    protected function getTwigExtensions(): array
    {
        $translator = new Translator('en');
        $translator->addLoader('xlf', new XliffFileLoader());

        return [
            new FormExtension(),
            new TranslationExtension($translator),
        ];
    }

    protected function getThemes(): array
    {
        return ['daisyui_layout.html.twig'];
    }

    public function testTextInputHasCorrectClasses(): void
    {
        $form = $this->factory->createBuilder()
            ->add('name', TextType::class, [
                'label' => 'Name',
            ])
            ->getForm();

        $html = $this->renderWidget($form['name']->createView());

        $this->assertMatchesXpath($html, '//input[contains(@class, "input") and contains(@class, "w-full")]');
    }

    public function testTextareaHasCorrectClasses(): void
    {
        $form = $this->factory->createBuilder()
            ->add('message', TextareaType::class, [
                'label' => 'Message',
            ])
            ->getForm();

        $html = $this->renderWidget($form['message']->createView());

        $this->assertMatchesXpath($html, '//textarea[contains(@class, "textarea") and contains(@class, "w-full")]');
    }

    public function testSelectHasCorrectClasses(): void
    {
        $form = $this->factory->createBuilder()
            ->add('choice', ChoiceType::class, [
                'label' => 'Choose',
                'choices' => [
                    'Option 1' => '1',
                    'Option 2' => '2',
                ],
            ])
            ->getForm();

        $html = $this->renderWidget($form['choice']->createView());

        $this->assertMatchesXpath($html, '//select[contains(@class, "select") and contains(@class, "w-full")]');
    }

    public function testCheckboxHasCorrectClasses(): void
    {
        $form = $this->factory->createBuilder()
            ->add('agree', CheckboxType::class, [
                'label' => 'I agree',
                'required' => false,
            ])
            ->getForm();

        $html = $this->renderWidget($form['agree']->createView());

        $this->assertMatchesXpath($html, '//input[@type="checkbox" and contains(@class, "checkbox") and contains(@class, "checkbox-xs")]');
    }

    public function testRadioHasCorrectClasses(): void
    {
        $form = $this->factory->createBuilder()
            ->add('gender', ChoiceType::class, [
                'label' => 'Gender',
                'choices' => [
                    'Male' => 'm',
                    'Female' => 'f',
                ],
                'expanded' => true,
            ])
            ->getForm();

        $html = $this->renderWidget($form['gender']->createView());

        $this->assertMatchesXpath($html, '//input[@type="radio" and contains(@class, "radio") and contains(@class, "radio-xs")]', 2);
    }

    public function testSubmitButtonHasCorrectClasses(): void
    {
        $form = $this->factory->createBuilder()
            ->add('submit', SubmitType::class, [
                'label' => 'Submit',
            ])
            ->getForm();

        $html = $this->renderWidget($form['submit']->createView());

        $this->assertMatchesXpath($html, '//button[contains(@class, "btn") and contains(@class, "btn-primary")]');
    }

    public function testFileInputHasCorrectClasses(): void
    {
        $form = $this->factory->createBuilder()
            ->add('file', FileType::class, [
                'label' => 'Upload',
            ])
            ->getForm();

        $html = $this->renderWidget($form['file']->createView());

        $this->assertMatchesXpath($html, '//input[@type="file" and contains(@class, "file-input") and contains(@class, "w-full")]');
    }

    public function testEmailInputHasCorrectClasses(): void
    {
        $form = $this->factory->createBuilder()
            ->add('email', EmailType::class, [
                'label' => 'Email',
            ])
            ->getForm();

        $html = $this->renderWidget($form['email']->createView());

        $this->assertMatchesXpath($html, '//input[@type="email" and contains(@class, "input") and contains(@class, "w-full")]');
    }

    public function testPasswordInputHasCorrectClasses(): void
    {
        $form = $this->factory->createBuilder()
            ->add('password', PasswordType::class, [
                'label' => 'Password',
            ])
            ->getForm();

        $html = $this->renderWidget($form['password']->createView());

        $this->assertMatchesXpath($html, '//input[@type="password" and contains(@class, "input") and contains(@class, "w-full")]');
    }

    public function testFormErrorsHaveCorrectClasses(): void
    {
        $form = $this->factory->createBuilder()
            ->add('name', TextType::class, [
                'label' => 'Name',
            ])
            ->getForm();

        $form->get('name')->addError(new FormError('This field is required'));

        $html = $this->renderRow($form['name']->createView());

        //$this->assertMatchesXpath($html, '//input[contains(@class, "input-error")]');
        $this->assertMatchesXpath($html, '//div[contains(@class, "text-error")]');
    }

    public function testFormHelpTextHasCorrectClasses(): void
    {
        $form = $this->factory->createBuilder()
            ->add('name', TextType::class, [
                'label' => 'Name',
                'help' => 'Enter your full name',
            ])
            ->getForm();

        $html = $this->renderRow($form['name']->createView());

        $this->assertMatchesXpath($html, '//*[contains(@class, "text-xs") and contains(@class, "text-base-content/60") and contains(text(), "Enter your full name")]');
    }
}
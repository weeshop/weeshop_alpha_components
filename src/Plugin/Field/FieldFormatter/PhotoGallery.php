<?php

namespace Drupal\weeshop_alpha_components\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\image\Plugin\Field\FieldFormatter\ImageFormatterBase;

/**
 * Plugin implementation of the 'weeshop_alpha_components_photo_gallery' formatter.
 *
 * @FieldFormatter(
 *   id = "weeshop_alpha_components_photo_gallery",
 *   label = @Translation("Photo gallery"),
 *   field_types = {
 *     "image"
 *   }
 * )
 */
class PhotoGallery extends ImageFormatterBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      // Implement default settings.
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    return [
      // Implement settings form.
    ] + parent::settingsForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    // Implement settings summary.

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    $images = [];
    /** @var \Drupal\file\Entity\File[] $files */
    $files = $this->getEntitiesToView($items, $langcode);
    foreach ($files as $delta => $file) {
      $images[$delta] = [
        'content' => [
          '#theme' => 'image',
          '#uri' => $file->getFileUri()
        ],
        'url' => Url::fromUri(file_create_url($file->getFileUri()))
      ];
    }

    $elements[0] = [
      '#theme' => 'weeshop_alpha_components_photo_gallery',
      '#images' => $images
    ];

    return $elements;
  }

  /**
   * Generate the output appropriate for one field item.
   *
   * @param \Drupal\Core\Field\FieldItemInterface $item
   *   One field item.
   *
   * @return string
   *   The textual output generated.
   */
  protected function viewValue(FieldItemInterface $item) {
    // The text value has no text format assigned to it, so the user input
    // should equal the output, including newlines.
    return nl2br(Html::escape($item->value));
  }

}

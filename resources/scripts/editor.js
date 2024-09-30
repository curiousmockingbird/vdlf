// Import necessary WordPress packages using ES6 imports
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import {
  RichText,
  InspectorControls,
  ColorPalette,
} from '@wordpress/block-editor';
import { PanelBody } from '@wordpress/components';

// Register a new block type
registerBlockType('vdlf/my-custom-block', {
  title: __('My Custom Block', 'vdlf'),
  description: __('A custom block for VDLF theme.', 'vdlf'),
  icon: 'smiley',
  category: 'common',
  attributes: {
    content: {
      type: 'string',
      source: 'html',
      selector: 'p',
    },
    color: {
      type: 'string',
      default: '#000000',
    },
  },
  edit: (props) => {
    const {
      attributes: { content, color },
      setAttributes,
      className,
    } = props;

    const onChangeContent = (newContent) => {
      setAttributes({ content: newContent });
    };

    const onChangeColor = (newColor) => {
      setAttributes({ color: newColor });
    };

    return (
      <>
        <InspectorControls>
          <PanelBody title={__('Text Color', 'vdlf')}>
            <ColorPalette value={color} onChange={onChangeColor} />
          </PanelBody>
        </InspectorControls>
        <RichText
          tagName="p"
          className={className}
          onChange={onChangeContent}
          value={content}
          style={{ color: color }}
          placeholder={__('Write your content here...', 'vdlf')}
        />
      </>
    );
  },
  save: (props) => {
    const {
      attributes: { content, color },
    } = props;

    return (
      <RichText.Content
        tagName="p"
        value={content}
        style={{ color: color }}
      />
    );
  },
});
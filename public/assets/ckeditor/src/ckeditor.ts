/**
 * @license Copyright (c) 2014-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */

import { ClassicEditor } from "@ckeditor/ckeditor5-editor-classic";

import { Autoformat } from "@ckeditor/ckeditor5-autoformat";
import {
  Bold,
  Code,
  Italic,
  Strikethrough,
  Subscript,
  Superscript,
  Underline,
} from "@ckeditor/ckeditor5-basic-styles";
import { BlockQuote } from "@ckeditor/ckeditor5-block-quote";
import { CodeBlock } from "@ckeditor/ckeditor5-code-block";
import { Essentials } from "@ckeditor/ckeditor5-essentials";
import { FindAndReplace } from "@ckeditor/ckeditor5-find-and-replace";
import {
  FontBackgroundColor,
  FontColor,
  FontFamily,
  FontSize,
} from "@ckeditor/ckeditor5-font";
import { Heading } from "@ckeditor/ckeditor5-heading";
import { Highlight } from "@ckeditor/ckeditor5-highlight";
import { HorizontalLine } from "@ckeditor/ckeditor5-horizontal-line";
import { HtmlEmbed } from "@ckeditor/ckeditor5-html-embed";
import { HtmlComment } from "@ckeditor/ckeditor5-html-support";
import { Indent, IndentBlock } from "@ckeditor/ckeditor5-indent";
import { Link } from "@ckeditor/ckeditor5-link";
import { List, TodoList } from "@ckeditor/ckeditor5-list";
import { MediaEmbed } from "@ckeditor/ckeditor5-media-embed";
import { Mention } from "@ckeditor/ckeditor5-mention";
import { Paragraph } from "@ckeditor/ckeditor5-paragraph";
import { PasteFromOffice } from "@ckeditor/ckeditor5-paste-from-office";
import { SourceEditing } from "@ckeditor/ckeditor5-source-editing";
import {
  SpecialCharacters,
  SpecialCharactersArrows,
  SpecialCharactersCurrency,
  SpecialCharactersEssentials,
  SpecialCharactersLatin,
  SpecialCharactersMathematical,
  SpecialCharactersText,
} from "@ckeditor/ckeditor5-special-characters";
import { Table, TableToolbar } from "@ckeditor/ckeditor5-table";
import { TextTransformation } from "@ckeditor/ckeditor5-typing";

// You can read more about extending the build with additional plugins in the "Installing plugins" guide.
// See https://ckeditor.com/docs/ckeditor5/latest/installation/plugins/installing-plugins.html for details.

class Editor extends ClassicEditor {
  public static override builtinPlugins = [
    Autoformat,
    BlockQuote,
    Bold,
    Code,
    CodeBlock,
    Essentials,
    FindAndReplace,
    FontBackgroundColor,
    FontColor,
    FontFamily,
    FontSize,
    Heading,
    Highlight,
    HorizontalLine,
    HtmlComment,
    HtmlEmbed,
    Indent,
    IndentBlock,
    Italic,
    Link,
    List,
    MediaEmbed,
    Mention,
    Paragraph,
    PasteFromOffice,
    SpecialCharacters,
    SpecialCharactersArrows,
    SpecialCharactersCurrency,
    SpecialCharactersEssentials,
    SpecialCharactersLatin,
    SpecialCharactersMathematical,
    SpecialCharactersText,
    Strikethrough,
    Subscript,
    Superscript,
    Table,
    TableToolbar,
    TextTransformation,
    TodoList,
    Underline,
  ];

  public static override defaultConfig = {
    toolbar: {
      items: [
        "undo",
        "redo",
        "|",
        "heading",
        "|",
        "bold",
        "italic",
        "link",
        "bulletedList",
        "numberedList",
        "|",
        "outdent",
        "indent",
        "|",
        "blockQuote",
        "insertTable",
        "code",
        "|",
        "codeBlock",
        "|",
        "|",
        "findAndReplace",
        "horizontalLine",
        "|",
        "htmlEmbed",
        "specialCharacters",
        "strikethrough",
        "subscript",
        "superscript",
        "-",
        "fontBackgroundColor",
        "fontFamily",
        "fontSize",
        "underline",
        "highlight",
        "fontColor",
        "|",
        "todoList",
      ],
      shouldNotGroupWhenFull: true,
    },
    language: "en",
    table: {
      contentToolbar: ["tableColumn", "tableRow", "mergeTableCells"],
    },
  };
}

export default Editor;

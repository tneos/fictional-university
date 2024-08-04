import "./index.scss";
import {TextControl, Flex, FlexBlock, FlexItem, Button, Icon} from "@wordpress/components";

const EditComponent = props => {
  const updateQuestion = value => {
    props.setAttributes({question: value});
  };
  const deleteAnswer = indexToDelete => {
    const newAnswers = props.attributes.answers.filter((_, index) => index !== indexToDelete);
    props.setAttributes({answers: newAnswers});
  };

  return (
    <div className="container-block">
      <TextControl
        label="Question: "
        value={props.attributes.question}
        onChange={updateQuestion}
      />
      <p style={{fontSize: "12px", margin: "20px 0 8px 0"}}>Answers: </p>
      {props.attributes.answers.map((answer, index) => {
        return (
          <Flex>
            <FlexBlock>
              <TextControl
                style={{fontSize: "1rem"}}
                value={answer}
                onChange={newVal => {
                  const newAnswers = props.attributes.answers.concat([]);
                  newAnswers[index] = newVal;
                  props.setAttributes({answers: newAnswers});
                }}
              />
            </FlexBlock>
            <FlexItem>
              <Button>
                <Icon className="mark-as-correct" icon="star-empty" />
              </Button>
            </FlexItem>
            <FlexItem>
              <Button isLink className="delete-btn" onClick={() => deleteAnswer(index)}>
                Delete
              </Button>
            </FlexItem>
          </Flex>
        );
      })}
      <Button
        isPrimary
        onClick={() => {
          props.setAttributes({answers: props.attributes.answers.concat([""])});
        }}
      >
        Add another answer
      </Button>
    </div>
  );
};

wp.blocks.registerBlockType("plugins/custom-btype", {
  title: "Custom block type",
  icon: "smiley",
  category: "common",
  attributes: {
    question: {type: "string"},
    answers: {type: "array", default: ["green", "pink"]},
  },
  edit: EditComponent,
});

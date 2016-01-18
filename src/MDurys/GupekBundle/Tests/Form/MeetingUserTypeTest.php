<?php

namespace MDurys\GupekBundle\Tests\Form;

use Symfony\Component\Form\Test\TypeTestCase;
use MDurys\GupekBundle\Entity\MeetingUser;
use MDurys\GupekBundle\Form\MeetingUserType;

class MeetingUserTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            'place' => 2,
            ];

        $type = new MeetingUserType();
        $form = $this->factory->create($type);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertInstanceOf(MeetingUser::class, $form->getData());

        $view = $form->createView();
        $children = $view->children;
        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}

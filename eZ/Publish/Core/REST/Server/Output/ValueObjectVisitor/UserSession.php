<?php
/**
 * File containing the UserSession ValueObjectVisitor class
 *
 * @copyright Copyright (C) 1999-2013 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 */

namespace eZ\Publish\Core\REST\Server\Output\ValueObjectVisitor;

use eZ\Publish\Core\REST\Common\Output\ValueObjectVisitor;
use eZ\Publish\Core\REST\Common\Output\Generator;
use eZ\Publish\Core\REST\Common\Output\Visitor;

/**
 * UserSession value object visitor
 */
class UserSession extends ValueObjectVisitor
{
    /**
     * Visit struct returned by controllers
     *
     * @param \eZ\Publish\Core\REST\Common\Output\Visitor $visitor
     * @param \eZ\Publish\Core\REST\Common\Output\Generator $generator
     * @param \eZ\Publish\Core\REST\Server\Values\UserSession $data
     */
    public function visit( Visitor $visitor, Generator $generator, $data )
    {
        $visitor->setHeader( 'Content-Type', $generator->getMediaType( 'Session' ) );

        //@todo Needs refactoring, disabling certain headers should not be done this way
        $visitor->setHeader( 'Accept-Patch', false );

        $generator->startObjectElement( 'Session' );

        $generator->startAttribute( 'href', $this->urlHandler->generate( 'userSession', array( 'sessionId' => $data->identifier ) ) );
        $generator->endAttribute( 'href' );

        $generator->startValueElement( 'name', $data->sessionName );
        $generator->endValueElement( 'name' );

        $generator->startValueElement( 'identifier', $data->identifier );
        $generator->endValueElement( 'identifier' );

        $generator->startValueElement( 'csrf-param', $data->csrfParam );
        $generator->endValueElement( 'csrf-param' );

        $generator->startValueElement( 'csrf-token', $data->csrfParam );
        $generator->endValueElement( 'csrf-token' );

        $generator->startObjectElement( 'User', 'User' );
        $generator->startAttribute(
            'href',
            // @todo check URL generator entry
            $this->urlHandler->generate( 'user', array( 'user' => $data->user->id ) )
        );
        $generator->endAttribute( 'href' );
        $generator->endObjectElement( 'User' );

        $generator->endObjectElement( 'Session' );
    }
}
